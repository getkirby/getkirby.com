<?php snippet('templates/plugins/section', [
	'id'      => 'paper',
	'icon'    => 'code',
	'title'   => 'Commands for Kirby CLI',
	'layout'  => 'cards',
	'columns' => 2,
	'plugins' => $plugins->filter('subcategory', 'cli')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
	'id'      => 'paper',
	'icon'    => 'code',
	'title'   => 'Debugging',
	'layout'  => 'hero',
	'columns' => 1,
	'plugins' => $plugins->filter('subcategory', 'debugging')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
	'id'      => 'plugins',
	'icon'    => 'code',
	'title'   => 'Plugin development',
	'layout'  => 'cards',
	'columns' => 3,
	'plugins' => $plugins->filter('subcategory', 'plugins')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
	'id'      => 'paper',
	'icon'    => 'code',
	'title'   => 'Logging',
	'layout'  => 'cards',
	'hero'    => true,
	'columns' => 2,
	'plugins' => $plugins->filter('subcategory', 'logging')->sortBy('sort', 'desc')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
	'id'      => 'utilities',
	'icon'    => 'code',
	'title'   => 'Utilities',
	'layout'  => 'cards',
	'hero'    => true,
	'columns' => 2,
	'plugins' => $plugins->filter('subcategory', '')->sortBy('sort', 'desc')->pluck('id')
]) ?>
