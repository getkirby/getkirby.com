<?php
/** @var $upcoming \Kirby\Cms\Pages */
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=kirby-meetups.ics');
?>
BEGIN:VCALENDAR
VERSION:2.0
X-WR-CALNAME:Kirby Meetups
NAME:Kirby Meetups
PRODID:-//getkirby.com//Meetups//EN
REFRESH-INTERVAL;VALUE=DURATION:P1D
CALSCALE:GREGORIAN
<?php
foreach ($upcoming as $event) {
	snippet('templates/meet/calendar', ['event' => $event]);
}
?>
END:VCALENDAR
