<?php

return function () {
	return [
		'events'   => $events = collection('events'),
		'upcoming' => $events->filterBy('isUpcoming', true),
		'past'     => $events->filterBy('isUpcoming', false),
		'gallery'  => $events->images()->shuffle(),
	];
};
