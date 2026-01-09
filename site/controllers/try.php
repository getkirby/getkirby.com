<?php

use Kirby\Cms\Page;

return function (Page $page) {
	$messages = [
		'deleted'    => 'Your demo instance was deleted successfully. Thanks for trying out Kirby! You can create a new demo at any time.',
		'not-found'  => 'The requested demo instance does not exist or has expired. Feel free to create a new instance.',
		'overload'   => 'Our demo server is currently being used by a lot of users, please try again later. Sorry for the inconvenience!',
		'rate-limit' => 'Your IP address has reached the maximum number of concurrent demo instances. Please try again later or continue with one of your existing instances. Maybe your colleague has one you can play around with together? :)',
		'referrer'   => 'Thanks for your interest in the Kirby demo. Your personal demo can only be created from this official Kirby website. Please use the button below to get started.',
		'default'    => 'An unexpected error occured in the demo manager. Please let us know if this keeps happening. Thanks!',
	];

	if ($status = (param('error') ?? param('status'))) {
		$message = $messages[$status] ?? $messages['default'];
		$status  = match($status) {
			'deleted', 'referrer' => 'info',
			default               => 'warning'
		};
	}

	$zones = $allowedHosts = ['zone1', 'zone2'];
	$allowedTypes          = ['next', 'staging'];

	foreach ($zones as $zone) {
		foreach ($allowedTypes as $type) {
			$allowedHosts[] = $type . '.' . $zone;
		}
	}

	$demo = param('demo');
	if (in_array($demo, $allowedHosts) === true) {
		$detectHost = false;
		$host       = 'https://' . $demo . '.trykirby.com';
	} elseif (in_array($demo, $allowedTypes) === true) {
		$detectHost = true;
		$host       = 'https://' . $demo . '.zone1.trykirby.com';

		// override the subdomains for the detection
		foreach ($zones as $i => $zone) {
			$zones[$i] = $demo . '.' . $zone;
		}
	} else {
		$detectHost = true;
		$host       = 'https://zone1.trykirby.com';
	}

	return [
		'detectHost' => $detectHost,
		'host'       => $host,
		'message'    => $message ?? null,
		'questions'  => $page->find('answers')->children(),
		'status'     => $status ?? null,
		'zones'      => $zones
	];
};
