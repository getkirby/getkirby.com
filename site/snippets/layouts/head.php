<?php
extract([
	'meta' => $page->meta()
]);
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php if (option('noindex') === true): ?>
<meta name="robots" content="noindex">
<?php endif ?>

<title><?= $page->isHomePage() ? $page->title() : $page->title() . ' | ' . $site->title() ?></title>

<link rel="preload" href="<?= url('/assets/css/index.css') ?>" as="style">
<link rel="modulepreload" href="<?= url('/assets/js/polyfills/dialog.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/code.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/lightbox.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/menu.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/search.js') ?>">

<script type="module">
	window.debounce = (callback, delay) => {
		let timeout;
		return () => {
			clearTimeout(timeout);
			timeout = setTimeout(callback, delay);
		}
	}

	import "<?= url('/assets/js/polyfills/dialog.js') ?>";
	import Code from "<?= url('/assets/js/components/code.js') ?>";
	import Menu from "<?= url('/assets/js/components/menu.js') ?>";
	import Search from "<?= url('/assets/js/components/search.js') ?>";

	new Code();
	new Menu();
	new Search();
</script>

<?= js('assets/js/components/lightbox.js') ?>

<?php if($page->id() === 'buy'): ?>
<link rel="preload" href="<?= url('buy/prices') ?>" as="fetch" />
<?php endif ?>

<?= css('assets/css/index.css') ?>

<link rel="icon" type="image/png" href="<?= url('/assets/images/favicon.png') ?>">
<link rel="icon" type="image/svg+xml" href="<?= url('/assets/images/favicon.svg') ?>">
<link rel="mask-icon" href="<?= url('/assets/images/safari-mask-icon.svg') ?>" color="#000">
<link href="<?= url('releases.rss') ?>" rel="alternate" type="application/rss+xml" title="Kirby Releases" />
<link href="<?= url('kosmos.rss') ?>" rel="alternate" type="application/rss+xml" title="Kirby Kosmos Archive" />
<link rel="manifest" href="<?= url('app.webmanifest') ?>" />

<?= $meta->robots() ?>
<?= $meta->jsonld() ?>
<?= $meta->opensearch() ?>
<?= $meta->social() ?>
