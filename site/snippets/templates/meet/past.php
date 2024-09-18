<?php if ($events->count() > 0): ?>
	<section class="events mb-24">
		<header class="flex justify-between items-center mb-6">
			<h2 class="h2">Past events</h2>
		</header>
		<?php snippet('templates/meet/events', ['events' => $events]) ?>
	</section>
<?php endif ?>
