<?php layout('cookbook') ?>

<?php slot('h1') ?>
	<?= $page->title() ?> recipes
<?php endslot() ?>

<?php slot() ?>
	<?php snippet('templates/cookbook/recipes', [
		'recipes' => $recipes
	]) ?>
<?php endslot() ?>
