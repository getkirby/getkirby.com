<?php if ($events->count() > 0): ?>
<ul class="mb-12 auto-fill" style="--min: 16rem; --gap: var(--spacing-12)">
	<?php foreach($events as $event): ?>
	<a href="<?= $event->link() ?>">
		<li class="bg-light p-3 rounded shadow">
			<h3 class="h5 mb-1"><?= $event->title() ?></h3>
			<p class="text-sm color-gray-700">
				<?= $event->date()->toDate('D j M, H:i') ?>
			</p>
		</li>
	</a>
	<?php endforeach ?>
</ul>
<?php endif ?>
