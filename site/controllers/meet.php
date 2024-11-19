<?php

use Kirby\Cms\App;

return function (App $kirby) {
	$events   = collection('events');
	$upcoming = $events->filterBy('isUpcoming', true);

	// expire the cache 2h after the next upcoming event starts
	if ($next = $upcoming->first()) {
		$time = $next->datetime()->getTimestamp() + (60 * 60 * 2);
		$kirby->response()->expires($time);
		$kirby->response()->header('Expires', gmdate('D, d M Y H:i:s T', $time));
	}

	return [
		'events'   => $events,
		'upcoming' => $upcoming->sortBy('num', 'asc'),
		'past'     => $events->filterBy('isUpcoming', false),
		'gallery'  => $events->images()->shuffle(),
	];
};
