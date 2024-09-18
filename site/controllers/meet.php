<?php

use Kirby\Cms\Page;

return function (Page $page) {
	return [
		'events'   => $events = collection('events'),
		'upcoming' => $events->filterBy('isUpcoming', true),
		'past'     => $events->filterBy('isUpcoming', false),
		'gallery'  => $events->images(),
	];
};
