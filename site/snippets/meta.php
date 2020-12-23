
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="<?= cloudinary('favicon.png') ?>">
<link rel="mask-icon" href="<?= cloudinary('safari-mask-icon.svg') ?>" color="#000">

<title><?= $page->isHomePage() ? $page->title() : $page->title() . ' | ' . $site->title() ?></title>

<?php if(option('keycdn', false) !== false): ?>
<link rel="dns-prefetch" href="<?= option('keycdn.domain') ?>">
<link rel="preconnect" href="<?= option('keycdn.domain') ?>">
<?php endif ?>

<?php if(option('cloudinary', false) !== false): ?>
<link rel="dns-prefetch" href="https://res.cloudinary.com">
<link rel="preconnect" href="https://res.cloudinary.com">
<?php endif ?>

<link rel="preload" href="<?= url($kirby->url('assets') . '/css/index.css') ?>" as="style">
<link rel="modulepreload" href="<?= url($kirby->url('assets') . '/js/index.js') ?>" as="script">

<?php if ($page->template()->name() === 'buy'): ?>
<link rel="preload" href="https://cdn.paddle.com/paddle/paddle.js" as="script">
<?php else: ?>
<link rel="dns-prefetch" href="https://cdn.paddle.com">
<link rel="preconnect" href="https://cdn.paddle.com">
<?php endif ?>

<?php $meta = $page->meta() ?>

<?= $meta->robots() ?>

<?= $meta->jsonld() ?>

<?= $meta->opensearch() ?>

<?= $meta->social() ?>
