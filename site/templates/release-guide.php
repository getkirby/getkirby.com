<?php
/**
 * @var ReleaseGuidePage $page
 */
?>
<?php layout('release-guide') ?>

<?php slot('sidebar') ?>
<?php $release = $page->release() ?>
<?php snippet([
	'templates/release-' . $release->versionField() . '/sidebar',
	'sidebar'
], [
	'release' => $release,
	'title'   => $release->title(),
	'link'    => $release->url(),
	'menu'    => $release->children()->listed(),
]) ?>
<?php endslot() ?>
