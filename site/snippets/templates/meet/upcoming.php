<?php if ($events->count() > 0): ?>
	<section class="events mb-24">
		<header class="flex justify-between items-center mb-6">
			<h2 class="h2">Upcoming events</h2>

			<nav class="flex" style="gap: var(--spacing-3)">
				<a
					class="btn btn--outlined"
					href="<?= $page->webcalUrl() ?>"
				>
					<?= icon('calendar') ?>
					Add to calendar
				</a>
				<a
					class="btn btn--filled"
					href="mailto:mail@getkirby.com"
				>
					<?= icon('add') ?>
					Add event
				</a>
			</nav>
		</header>
		<?php snippet('templates/meet/events', ['events' => $events]) ?>
	</section>
<?php endif ?>
