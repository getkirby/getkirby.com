<?php snippet('templates/plugins/section', [
	'id'      => 'panel',
	'icon'    => 'seo',
	'hero'    => true,
	'title'   => 'Panel',
	'layout'  => 'cards',
	'columns' => 2,
	'plugins' => [
		'plugins/tobimori/seo',
		'plugins/diesdasdigital/meta-knight',
		'plugins/fabianmichael/meta',
	]
]) ?>

<?php snippet('templates/plugins/section', [
	'id'      => 'utilities',
	'icon'    => 'analytics',
	'title'   => 'Templating',
	'layout'  => 'cards',
	'columns' => 2,
	'plugins' => $plugins->filter('subcategory', 'templating')->pluck('id')
]) ?>

<?php snippet('templates/plugins/section', [
	'id'      => 'utilities',
	'icon'    => 'analytics',
	'title'   => 'Utilities',
	'layout'  => 'cards',
	'columns' => 3,
	'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]) ?>
