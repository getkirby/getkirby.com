<?php layout('reference') ?>

<?php snippet('templates/reference/search') ?>

<div class="mb-24">
	<?php snippet('templates/reference/section', $entries) ?>
</div>

<?php snippet('toc') ?>

<div class="prose">
	<?= $page->text()->kt() ?>
</div>

<?= js('assets/js/templates/reference-section.js') ?>
