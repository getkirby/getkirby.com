<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('sidebar', [
	'title'         => 'Guide',
	'link'          => '/docs/guide',
	'menu'          => collection('guides'),
	'hasCategories' => true,
]) ?>
<?php endslot() ?>

<?php slot('prevnext') ?>
<?php snippet('layouts/prevnext', [
	'siblings' => page('docs/guide')->index()->listed()
]) ?>
<?php endslot() ?>
