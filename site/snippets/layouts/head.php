<?php
extract([
  'meta' => $page->meta()
]);
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="<?= url('/assets/images/favicon.png') ?>">
<link rel="mask-icon" href="<?= url('/assets/images/safari-mask-icon.svg') ?>" color="#000">

<title><?= $page->isHomePage() ? $page->title() : $page->title() . ' | ' . $site->title() ?></title>

<link rel="preload" href="<?= url('/assets/css/index.css') ?>" as="style">
<link rel="modulepreload" href="<?= url('/assets/js/index.js') ?>">

<?php if (option('cdn', false) !== false): ?>
<link rel="dns-prefetch" href="<?= option('cdn.domain') ?>">
<link rel="preconnect" href="<?= option('cdn.domain') ?>">
<?php endif ?>

<?php if ($page->template()->name() === 'buy'): ?>
<link rel="preload" href="https://cdn.paddle.com/paddle/paddle.js" as="script">
<?php else: ?>
<link rel="dns-prefetch" href="https://cdn.paddle.com">
<link rel="preconnect" href="https://cdn.paddle.com">
<?php endif ?>

<?= $meta->robots() ?>
<?= $meta->jsonld() ?>
<?= $meta->opensearch() ?>
<?= $meta->social() ?>

<?= css('/assets/css/index.css') ?>
<?= js(['/assets/js/index.js'], ['type' => 'module']) ?>

