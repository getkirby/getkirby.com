<?php
/**
 * @var Kirby\Cms\Pages $upcoming
 * @var Kirby\Cms\Pages $past
 */
$upcomingEvents = [];
$pastEvents     = [];

$since = param('since');

foreach ($upcoming as $event) {
	$upcomingEvents[] = [
		'title'    => $event->shortTitle()->value(),
		'date'     => $event->datetime()->format('c'),
		'timezone' => $event->timezone()->value(),
		'link'     => $event->link()->value(),
		'isMeetup' => $event->isMeetup(),
	
	];
}

// Only meetups, no other events
$past = $past->filterBy('city', '!=', '');

// Use param since to filter meetups after given date
if ($since = param('since')) {
	$past = $past->filterBy('num', '>', $since);
}

foreach ($past as $event) {
	$pastEvents[] = [
		'title' => $event->shortTitle()->value(),
		'date'  => $event->datetime()->format('c'),
		'link'  => $event->link()->value(),
		'isMeetup' => $event->isMeetup(),
	];
}

echo json([
	'upcoming' => $upcomingEvents,
	'past'     => $pastEvents,
]);