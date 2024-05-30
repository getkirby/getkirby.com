<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<style>
.release-box,
.release-code-box,
.release-padded-box,
.release-text-box {
	border-radius: .5rem;
	overflow: hidden;
	z-index: 1;
}
.release-code-box {
	display: grid;
	align-items: stretch;
	background: var(--color-black);
}
.release-code-box .code-toolbar {
	display: grid;
}
.release-padded-box,
.release-text-box {
	color: var(--color-gray-800);
	padding: var(--spacing-6);
}
.release-text-box {
	background: var(--color-white);
}
.release-padded-box h3,
.release-text-box h3 {
	font-weight: var(--font-bold);
	font-size: var(--text-lg);
}
.release-padded-box .prose,
.release-text-box .prose {
	color: inherit;
}
.release-text-box .prose {
	font-size: var(--text-lg);
}

@media screen and (min-width: 60rem) {
	.release-text-box,
	.release-padded-box {
		padding: var(--spacing-12);
	}
}
</style>

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
