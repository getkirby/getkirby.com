<ul class="columns" style="--columns-md: 1; --columns-lg: <?= $columns ?? 1 ?>; --gap: var(--spacing-1);">
	<?php foreach ($events as $event): ?>
	<li>
		<?php snippet('templates/meet/event', ['event' => $event]) ?>
	</li>
	<?php endforeach ?>
</ul>
