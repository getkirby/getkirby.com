<?php /** @var $event \Kirby\Cms\Page */ ?>
BEGIN:VEVENT
UID:meetup-<?= $event->slug() . "\r\n" ?>
SUMMARY:<?= $event->foldTitle() . "\r\n" ?>
DTSTART:<?= $event->datetime('UTC')->format('Ymd\THis\Z') . "\r\n" ?>
DTEND:<?= $event->datetime('UTC', 'end')->format('Ymd\THis\Z') . "\r\n" ?>
DTSTAMP:<?= $event->modified('Ymd\THis\Z') . "\r\n" ?>
<?php if ($event->city()->isNotEmpty()): ?>
LOCATION:<?= $event->city() ?>, <?= $event->country() . "\r\n" ?>
<?php endif ?>
<?php if ($event->link()->isNotEmpty()): ?>
URL:<?= $event->foldLink() . "\r\n" ?>
<?php endif ?>
BEGIN:VALARM
ACTION:DISPLAY
DESCRIPTION:<?= $event->foldTitle() . "\r\n" ?>
TRIGGER:-P1D
END:VALARM
END:VEVENT
