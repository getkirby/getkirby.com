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
	<?php foreach ($sections as $section): ?>
		<?php snippet([
			'templates/release-5/' . $section->slug(),
			'templates/release-5/section'
		], ['section' => $section]) ?>
	<?php endforeach ?>

	<?php snippet('templates/release-5/migration') ?>
</article>

<?php snippet('templates/releases/get-started') ?>

<?= js('assets/js/templates/release.js') ?>
