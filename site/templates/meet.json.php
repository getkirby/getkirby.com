<?php
/**
 * @var \Kirby\Cms\Pages $upcoming
 * @var \Kirby\Cms\Pages $past
 */

$since = param('since');

$upcomingEvents = $upcoming->toArray(fn($event) => [
	'title'    => $event->shortTitle()->value(),
	'date'     => $event->datetime()->format('c'),
	'timezone' => $event->timezone()->value(),
	'link'     => $event->link()->value(),
	'isMeetup' => $event->isMeetup(),
]);

// Only meetups, no other events
$past = $past->filterBy('city', '!=', '');

// Use param since to filter meetups after given date
if (is_string($since)) {
	$past = $past->filterBy('num', '>', $since);
}

$pastEvents = $past->toArray(fn($event) => [
	'title'    => $event->shortTitle()->value(),
	'date'     => $event->datetime()->format('c'),
	'link'     => $event->link()->value(),
	'isMeetup' => $event->isMeetup(),
]);

echo json([
	'upcoming' => $upcomingEvents,
	'past'     => $pastEvents,
]);