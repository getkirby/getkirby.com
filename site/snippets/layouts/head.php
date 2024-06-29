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

<?php if($page->uri() === 'buy'): ?>
<link rel="preload" href="<?= url('buy/prices') ?>" as="fetch" />
<?php endif ?>

<?php if($page->uri() === 'partners/join'): ?>
<link rel="preload" href="<?= url('partners/join/prices') ?>" as="fetch" />
<?php endif ?>

<?= css('assets/css/index.css') ?>
<?= js('assets/js/index.js', ['type' => 'module']) ?>

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
