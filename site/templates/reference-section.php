<?php layout('reference') ?>

<?php snippet('templates/reference/section-filter') ?>

<div class="mb-24">
	<?php snippet('templates/reference/section', $entries) ?>
</div>

<?php snippet('toc') ?>

<div class="prose">
	<?= $page->text()->kt() ?>
</div>