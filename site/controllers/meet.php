<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Community\Member;

return function (App $kirby, Page $page) {
	$message = null;

	// if form is submitted, create a GitHub PR
	if ($kirby->request()->is('POST')) {
		try {
			$input   = array_map('trim', get());
			$member  = Member::create(...$input);
			$pr      = $member->pr();

			$message = [
				'type' => 'success',
				'text' => "Thank you for your submission. We will review your entry and add it as soon as possible: <a href='$pr' class='link'>track the progress</a>."
			];
		} catch (Throwable $e) {
			$message = [
				'type' => 'alert',
				'text' =>  $e->getMessage()
			];
		}
	}

	return [
		'countries' => option('countries'),
		'events'    => $page->find('events')->children(),
		'gallery'   => $page->find('gallery')->images()->sortBy('sort'),
		'message'   => $message,
		'people'    => $page->find('people')->children()
	];
};
