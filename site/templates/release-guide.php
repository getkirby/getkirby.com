<?php layout('release-guide') ?>

<?php slot('sidebar') ?>
<?php $release = $page->release() ?>
<?php snippet('sidebar', [
	'title' => $release->title(),
	'link'  => $release->url(),
	'menu'  => $release->children()->listed(),
]) ?>
<?php endslot() ?>
