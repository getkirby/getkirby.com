<?php
/**
 * @var \Kirby\Cms\Pages $upcoming
 */

header('Content-Type: application/rss+xml; charset=UTF-8');

?><?xml version="1.0" encoding="utf-8"?><rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Kirby meetup calendar</title>
		<link>https://getkirby.com/meet</link>
		<description>Connect with other Kirby developers around the world or meet face-to-face at a local meetup.</description>
		<?php foreach ($upcoming as $event): ?>
			<?php if (empty(get('city')) || strtolower(get('city')) == strtolower($event->city())): ?>
				<item>
					<title><?= $event->datetime()->format('Y-m-d') ?>: <?= $event->shortTitle()->value() ?></title>
					<?php if ($event->link()->isNotEmpty()): ?>
						<link><?= $event->link()->value() ?></link>
					<?php endif ?>
					<guid>https://getkirby.com/meet#meetup-<?= $event->slug() ?></guid>
					<description><![CDATA[
						<p><?= $event->datetime()->format('Y-m-d H:i') ?> (time zone <?= $event->timezone()->value() ?>)</p>
						<?php if ($event->city()->isNotEmpty()): ?>
							<p><?= $event->city() ?>, <?= $event->country() ?></p>
						<?php endif ?>
						<?php if ($event->link()->isNotEmpty()): ?>
							<p><a href="<?= $event->link()->value() ?>"><?= $event->link()->value() ?></a></p>
						<?php endif ?>
					]]></description>
				</item>
			<?php endif ?>
		<?php endforeach ?>
	</channel>
</rss>
