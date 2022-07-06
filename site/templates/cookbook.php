<?php layout('cookbook') ?>

<?php slot('h1') ?>
Recipes
<?php endslot() ?>

<?php slot() ?>
<?php snippet('templates/cookbook/recipes', [
  'recipes' => $page
	->children()
	->listed()
	->children()
	->listed()
	->sortBy('published', 'desc')
]) ?>
<?php endslot() ?>
