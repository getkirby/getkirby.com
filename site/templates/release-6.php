<?php
/**
 * @var ReleasePage $page
 * @var Kirby\Cms\Pages $sections
 */
?>
<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<?php
$buttons = [
	[
		'text'  => 'Docs',
		'link'  => page('releases/6')->children()->first()->url(),
		'icon'  => 'book',
		'style' => 'outlined'
	],
	[
		'text' => 'Try the beta',
		'link' => $page->tryLink()->or('https://github.com/getkirby/kirby/releases'),
		'icon' => 'download'
	]
];
?>

<header class="mb-36 flex items-end justify-between release-header">
	<div>
		<h1 class="h1"><?= $page->title() ?></h1>
		<p class="h1 color-gray-600"><?= $page->subtitle() ?></p>
	</div>
	<?php snippet('cta', [
		'buttons' => $buttons,
		'center'  => false,
		'mb'      => 0
	]) ?>
</header>

<article class="release-wrapper">
	<?php foreach ($sections as $section): ?>
		<?php snippet([
			'templates/release-5/' . $section->slug(),
			'templates/release-5/section'
		], ['section' => $section]) ?>
	<?php endforeach ?>
</article>

<?php snippet('templates/release-6/migration') ?>

<section id="get-started" class="mb-42">
	<h2 class="h2 text-center mb-6">Get started</h2>
	<p class="text-lg text-center mb-12">
		Kirby 6 will be a <strong>free upgrade</strong> for everyone with a <a href="/buy" class="link">valid Kirby Basic or Enterprise license</a>.
	</p>
	<?php snippet('cta', ['buttons' => $buttons]) ?>
</section>

<?= js('assets/js/templates/release.js') ?>
