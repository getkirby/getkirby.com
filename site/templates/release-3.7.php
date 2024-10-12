<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<header class="mb-36 flex items-end justify-between release-header">
	<div>
		<h1 class="h1"><?= $page->title() ?></h1>
		<p class="h1 color-gray-600"><?= $page->subtitle() ?></p>
	</div>

	<?php snippet('templates/releases/cta', [
		'options' => ['center' => false, 'mb' => 0]
	]) ?>
</header>

<article class="release-wrapper">

	<?php snippet('templates/release-37/stats') ?>
	<?php snippet('templates/release-37/table') ?>
	<?php snippet('templates/release-37/system') ?>
	<?php snippet('templates/release-37/toggles') ?>
	<?php snippet('templates/release-37/search') ?>
	<?php snippet('templates/release-37/ui') ?>

	<?php snippet('templates/release-37/changes') ?>
	<?php snippet('templates/release-37/contributors') ?>
	<?php snippet('templates/release-37/release-menu') ?>
</article>

<?php snippet('templates/releases/get-started') ?>

<?= js('assets/js/templates/release.js') ?>
