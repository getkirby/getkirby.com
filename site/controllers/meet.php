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
		...($oauth->user() ?? []),
	];

	// normalize the user
	$user = match ($oauth->provider()) {
		'discord' => [
			...$user,
			'business' => $user['company']     ?? '',
			'discord'  => $user['username']    ?? '',
			'name'     => $user['global_name'] ?? '',
			...get()
		],
		'github' => [
			...$user,
			'business' => $user['company'] ?? '',
			'github'   => $user['login']   ?? '',
			'name'     => $user['name']    ?? '',
			...get()
		],
		default => $user
	};

	return [
		'events'  => $page->find('events')->children(),
		'gallery' => $page->find('gallery')->images()->sortBy('sort'),
		'message' => $message,
		'oauth'   => $oauth,
		'people'  => $page->find('people')->children(),
		'user'    => $user
	];
};
