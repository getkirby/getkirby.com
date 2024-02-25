<?php layout('cookbook') ?>

<?php slot('h1') ?>
	Recipes
<?php endslot() ?>

<?php slot() ?>
	<?php snippet('templates/cookbook/recipes', [
		'recipes' => $recipes
			->sortBy('published', 'desc')
	]) ?>
<?php endslot() ?>
