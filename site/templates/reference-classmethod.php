<?php layout('reference') ?>

<div class="prose">
	<?php snippet('templates/reference/entry/call') ?>
	<?php snippet('templates/reference/entry/class') ?>

	<?= $page->text()->kt() ?>

	<?php if ($page->example()->isNotEmpty()): ?>
		<h2>Example</h2>
		<?= $page->example()->kt() ?>
	<?php endif ?>
</div>
