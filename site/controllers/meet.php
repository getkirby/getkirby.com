<?php

use Kirby\Cms\App;

return function (App $kirby) {
	$events   = collection('events');
	$upcoming = $events->filterBy('isUpcoming', true);

	// expire the cache 2h after the next upcoming event starts
	if ($next = $upcoming->sortBy('date', 'asc')->first()) {
		$time = $next->expiryTime();
		$kirby->response()->expires($time);
		$kirby->response()->header('Expires', gmdate('D, d M Y H:i:s T', $time));
	}

	if ($city = get('city')) {
		$upcoming = $upcoming->filterBy(
			fn ($event) => strtolower($event->city()) === strtolower($city)
		);
	}

	return [
		'events'   => $events,
		'upcoming' => $upcoming->sortBy('num', 'asc'),
		'past'     => $events->filterBy('isUpcoming', false),
		'gallery'  => $events->images()->shuffle(),
	];
};
