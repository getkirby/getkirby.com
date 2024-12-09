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
	<?php snippet('templates/release-38/uuids') ?>
	<?php snippet('templates/release-38/updates') ?>
	<?php snippet('templates/release-38/php8') ?>
	<?php snippet('templates/release-38/object-field') ?>
	<?php snippet('templates/release-38/cli') ?>
	<?php snippet('templates/release-38/gallery-block') ?>
	<?php snippet('templates/release-38/changes') ?>
	<?php snippet('templates/release-38/migration') ?>
	<?php snippet('templates/release-38/contributors') ?>
	<?php snippet('templates/release-38/release-menu') ?>
</article>

<?php snippet('templates/releases/get-started') ?>

<?= js('assets/js/templates/release.js') ?>
