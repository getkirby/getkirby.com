<a target="_blank" href="<?= $event->link() ?>" class="event">
	<h3><?= $event->icon() ?> <?= $event->shortTitle() ?></h3>

	<?php if ($event->isUpcoming() === true): ?>
		<localized-datetime
			date="<?= $event->datetime()->format('c') ?>"
			<?php if ($event->isMeetup()) : ?>
			timezone="<?= $event->timezone() ?>"
			<?php endif ?>
		>
			<?= $event->datetime()->format('D, j M Y, H:i T') ?>
		</localized-datetime>
	<?php else: ?>
	<time date="<?= $event->datetime()->format('c') ?>">
		<?= $event->datetime()->format('D, j M Y') ?>
	</time>
	<?php endif ?>
</a>
