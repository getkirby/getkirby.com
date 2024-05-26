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

<?php if($page->id() === 'meet'): ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="      crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
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
