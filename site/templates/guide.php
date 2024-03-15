<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('sidebar', [
	'title'         => 'Guide',
	'link'          => '/docs/guide',
	'menu'          => $menu,
	'hasCategories' => true,
]) ?>
<?php endslot() ?>

<?php slot('prevnext') ?>
<?php snippet('layouts/prevnext', ['siblings' => $prevnext]) ?>
<?php endslot() ?>
