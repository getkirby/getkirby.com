<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('sidebar', [
	'title'         => 'Guide',
	'link'          => page('docs/guide')->menuUrl(),
	'menu'          => $menu,
	'hasCategories' => true,
]) ?>
<?php endslot() ?>

<?php slot('resources') ?>
<?php snippet('resources', ['resources' => $resources]) ?>
<?php endslot() ?>

<?php slot('prevnext') ?>
<?php snippet('layouts/prevnext', ['siblings' => $prevnext]) ?>
<?php endslot() ?>
