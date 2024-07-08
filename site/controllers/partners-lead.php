<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Honey\Time;

return function (App $kirby, Page $page) {
	// submitted form
	if ($kirby->request()->is('POST') === true) {
		// spam protection
		try {
			Time::validate(get('timestamp'));
		} catch (Exception $e) {
			$status  = 'alert';
			$message = $e->getMessage();
		}

		$name     = get('name');
		$email    = get('email');
		$customer = get('customer');
		$company  = get('company');
		$contact  = get('contact');
		$project  = get('project');
		$partner  = get('partner');
		$language = get('language');
		$budget   = match(get('budget')) {
			'known'   => get('budget_available'),
			'unknown' => 'Recommendation needed'
		};

		$kirby->email([
			'from'     => 'partners@getkirby.com',
			'fromName' => 'Kirby Team',
			'to'       => $email,
			'subject'  => 'Your Kirby project request',
			'template' => 'partner-lead-response',
			'data'     => [
				'name' => $name
			]
		]);

		$kirby->email([
			'from'     => 'partners@getkirby.com',
			'fromName' => 'Kirby Team',
			'to'       => 'partners@getkirby.com',
			'subject'  => 'New project lead',
			'template' => 'partner-lead-request',
			'data'     => [
				'name'     => $name,
				'email'    => $email,
				'customer' => $customer,
				'company'  => $company,
				'contact'  => $contact,
				'project'  => $project,
				'partner'  => $partner,
				'budget'   => $budget,
				'language' => $language,
			]
		]);

		$status  = 'success';
		$message = 'Project has been posted';
	}

	return [
		'message'   => $message ?? null,
		'questions' => $page->find('answers')->children(),
		'status'    => $status ?? null,
		'timestamp' => Time::get()
	];
};
