<section id="get-started" class="mb-42">
	<h2 class="h2 text-center mb-6">Get started</h2>

	<?php if ($slot = $slots->default()): ?>
	<?= $slot ?>
	<?php endif ?>

	<?php snippet('templates/releases/cta') ?>
</section>
