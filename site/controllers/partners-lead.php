<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Honey\Time;

return function (App $kirby, Page $page) {
	// submitted form
	if ($kirby->request()->is('POST') === true) {
		try {
			// spam protection
			Time::validate(get('timestamp'));

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
				'to'       => 'partners@getkirby.com',
				'subject'  => 'New project lead',
				'template' => 'partner-lead',
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

			go('partners/lead/success');

		} catch (Exception $e) {
			$message = $e->getMessage();
		}
	}

	return [
		'message'   => $message ?? null,
		'questions' => $page->find('answers')->children(),
		'timestamp' => Time::get()
	];
};
