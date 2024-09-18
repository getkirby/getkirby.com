<a target="_blank" href="<?= $event->link() ?>" class="event">
	<h3>📍 Kirby Meetup <?= $event->shortTitle() ?></h3>

	<?php if ($event->isUpcoming() === true): ?>
	<localized-datetime date="<?= $event->date()->toDate('Y-m-d H:i:s') ?>"><?= $event->date()->toDate('D, j M Y, H:i T') ?></localized-datetime>
	<?php else: ?>
	<time date="<?= $event->date()->toDate('Y-m-d H:i:s') ?>"><?= $event->date()->toDate('D, j M Y') ?></time>
	<?php endif ?>
</a>
