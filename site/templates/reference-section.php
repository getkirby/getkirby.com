<?php layout('reference') ?>

<!-- Enforce empty default ToC slot -->
<?php slot('toc') ?>
<?php endslot() ?>

<?php slot() ?>
<?php snippet('templates/reference/section-filter') ?>

<div class="mb-24">
	<?php snippet('templates/reference/section', $entries) ?>
</div>

<!-- Custom ToC position -->
<?php snippet('toc') ?>

<div class="prose">
	<?= $page->text()->kt() ?>
</div>
<?php endslot() ?>
