<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Github\Github;
use Kirby\Toolkit\Str;

function getLngLat(string $address): array
{
	$mapbox	 = kirby()->option('keys.mapbox');
	$address = urlencode($address);
	$json    = file_get_contents("https://api.mapbox.com/geocoding/v5/mapbox.places/$address.json?access_token=" . $mapbox);
	$json    = json_decode($json);
	return  $json->features[0]->center;
}

function createContactGithubPr(Page $page): string
{
	$name      = get('name');
	$business  = get('business');
	$place     = get('place');
	$country   = get('country');
	$interests = implode(',', get('interests'));
	$expertise = get('expertise');
	$type      = get('type');
	$website   = get('website');
	$email	   = get('email');
	$forum	   = get('forum');
	$github    = get('github');
	$discord   = get('discord');
	$instagram = get('instagram');
	$mastodon  = get('mastodon');
	$linkedin  = get('linkedin');

	[$longitude, $latitude] = getLngLat($place . ', ' . $country);

	$content = <<<EOD
Name: $name

----

Business: $business

----

Type: $type

----

Place: $place

----

Country: $country

----

Latitude: $latitude

----

Longitude: $longitude

----

Interests: $interests

----

Expertise: $expertise

----

Website: $website

----

Email: $email

----

Forum: $forum

----

Github: $github

----

Discord: $discord

----

Instagram: $instagram

----

Mastodon: $mastodon

----

Linkedin: $linkedin

EOD;

	$repo = 'getkirby/playground-meet-api';
	$slug = Str::kebab($name);

	while ($page->find('people/' . $slug)) {
		$slug .= '-' . rand(0, 9);
	}

	$branch = Github::createBranch($repo, 'meet/' . $slug . '-' . time());

	Github::createFile(
		$repo,
		'content/meet/contact/' . $slug . '/meet-contact.txt',
		$content,
		$branch = $branch->json()['ref'],
		'New community map entry'
	);

	$pr = Github::createPr($repo, $branch, 'New community map entry');
	return $pr->json()['url'];
}

return function (App $kirby, Page $page) {
	$message = null;

	// if form is submitted, create a GitHub PR
	if ($kirby->request()->is('POST') && get('submit')) {
		try {
			$pr      = createContactGithubPr($page);
			$message = [
				'type' => 'success',
				'text' => "Thank you for your submission. We will review your entry and add it as soon as possible: <a href='$pr' class='link'>track the progress</a>."
			];
		} catch (Exception $e) {
			$message = [
				'type' => 'alert',
				'text' =>  $e->getMessage()
			];
		}
	}

	return [
		'message' => $message,
		'events'  => $page->find('events')->children(),
		'people'  => $page->find('people')->children()
	];
};
