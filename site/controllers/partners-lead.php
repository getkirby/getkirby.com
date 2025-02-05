<?php

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Honey\Time;
use Kirby\Toolkit\V;

V::$validators['nospam'] = function ($value) {
	if (V::num($value) === true) {
		return false;
	}

	return true;
};


return function (App $kirby, Page $page) {
	// submitted form
	if ($kirby->request()->is('POST') === true) {
		try {
			$input = get([
				'timestamp',
				'name',
				'email',
				'customer',
				'company',
				'contact',
				'project',
				'partner',
				'language',
				'budget',
				'budget_available'
			]);

			if (V::between($input['name'], 1, 100) === false || V::nospam($input['name']) === false) {
				throw new Exception('Please, enter a valid name');
			}

			if (V::email($input['email']) === false) {
				throw new Exception('Please, enter a valid email address');
			}

			if (V::in($input['customer'], ['private', 'small', 'mediumlarge', 'agency']) === false) {
				throw new Exception('Please, select a valid customer type');
			}

			if (V::between($input['company'], 1, 100) === false || V::nospam($input['company']) === false) {
				throw new Exception('Please, enter a valid company name');
			}

			if (V::maxlength($input['contact'], 360) === false || V::nospam($input['contact']) === false) {
				throw new Exception('Please, enter valid contact information');
			}

			if (V::maxlength($input['language'], 100) === false || V::nospam($input['language']) === false) {
				throw new Exception('Please, enter valid language');
			}

			if (V::between($input['project'], 40, 1000) === false || V::nospam($input['project']) === false) {
				throw new Exception('Please, enter valid project description');
			}

			if (V::in($input['budget'], ['known', 'unknown']) === false) {
				throw new Exception('Please, select a valid budget');
			}

			if (V::maxlength($input['budget_available'], 100) === false || V::nospam($input['budget_available']) === false) {
				throw new Exception('Please, enter valid budget');
			}

			if (V::maxlength($input['partner'], 100) === false || V::nospam($input['partner']) === false) {
				throw new Exception('Please, enter valid partner');
			}

			// spam protection
			Time::validate($input['timestamp']);

			$budget = match($input['budget']) {
				'known'   => $input['budget_available'],
				'unknown' => 'Recommendation needed'
			};

			$kirby->email([
				'from'     => 'partners@getkirby.com',
				'fromName' => 'Kirby Team',
				'to'       => 'partners@getkirby.com',
				'subject'  => 'New project lead',
				'template' => 'partner-lead',
				'data'     => [
					'name'     => $input['name'],
					'email'    => $input['email'],
					'customer' => $input['customer'],
					'company'  => $input['company'],
					'contact'  => $input['contact'],
					'project'  => $input['project'],
					'partner'  => $input['partner'],
					'budget'   => $budget,
					'language' => $input['language'],
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
