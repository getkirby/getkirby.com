<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Community\Member;

return function (App $kirby, Page $page) {
	$message = null;
	$oauth = oauth();

	// if form is submitted, create a GitHub PR
	if ($kirby->request()->is('POST')) {
		try {
			$input  = array_map('trim', get());
			$member = Member::create(...$input);
			$pr     = $member->pr();

			$message = [
				'type' => 'success',
				'pr'   => $pr
			];
		} catch (Throwable $e) {
			$message = [
				'type' => 'alert',
				'text' =>  $e->getMessage()
			];
		}
	}

	$user = [
		...$oauth->user(),
		'business'  => '',
		'country'   => '',
		'discord'   => '',
		'forum'     => '',
		'github'    => '',
		'instagram' => '',
		'linkedin'  => '',
		'name'      => '',
		'mastodon'  => '',
		'place'     => '',
	];

	// normalize the user
	$user = match ($oauth->provider()) {
		'discord' => [
			...$user,
			'business' => $oauth->user()['company']     ?? '',
			'discord'  => $oauth->user()['username']    ?? '',
			'name'     => $oauth->user()['global_name'] ?? '',
		],
		'github' => [
			...$user,
			'business' => $oauth->user()['company'] ?? '',
			'github'   => $oauth->user()['login']   ?? '',
			'name'     => $oauth->user()['name']    ?? '',
		],
		default => null
	};

	$user = [...$user, ...get()];

	return [
		'events'  => $page->find('events')->children(),
		'gallery' => $page->find('gallery')->images()->sortBy('sort'),
		'message' => $message,
		'oauth'   => $oauth,
		'people'  => $page->find('people')->children(),
		'user'    => $user
	];
};
