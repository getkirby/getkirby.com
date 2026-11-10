<?php
/**
 * @var ReferencePanelFieldPage $page
 */
?>
<?php layout('reference') ?>

<?php slot('toc') ?>
<?php snippet('toc', ['items' => $page->toc()]) ?>
<?php endslot() ?>

<?php slot() ?>
<div class="prose">
	<?php snippet('templates/reference/entry/parameters', [
		'title'       => 'Field options',
		'reflectable' => $page->options()
	]) ?>

	<?= $page->text()->kt() ?>
</div>
<?php endslot() ?>
