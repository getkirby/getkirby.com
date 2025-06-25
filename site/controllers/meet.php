<?php

use Kirby\Cms\App;

return function (App $kirby) {
	$events   = collection('events');
	$upcoming = $events->filterBy('isUpcoming', true);

	// expire the Kirby and CDN caches 2h after the next upcoming event starts
	if ($next = $upcoming->sortBy('date', 'asc')->first()) {
		$time = $next->expiryTime();
		$kirby->response()->expires($time);
		$kirby->response()->header('Cache-Control', 's-maxage=' . ($time - time()));
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
