<ul>
	<?php foreach ($events as $event): ?>
	<li>
		<?php snippet('templates/meet/event', ['event' => $event]) ?>
	</li>
	<?php endforeach ?>
</ul>
