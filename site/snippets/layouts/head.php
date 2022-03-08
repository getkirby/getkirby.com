<?php
extract([
  'meta' => $page->meta()
]);
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $page->isHomePage() ? $page->title() : $page->title() . ' | ' . $site->title() ?></title>

<link rel="preload" href="<?= url('/assets/css/index.css') ?>" as="style">
<link rel="modulepreload" href="<?= url('/assets/js/polyfills/dialog.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/code.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/lightbox.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/menu.js') ?>">
<link rel="modulepreload" href="<?= url('/assets/js/components/search.js') ?>">

<?php if (option('cdn', false) !== false) : ?>
  <link rel="dns-prefetch" href="<?= option('cdn.domain') ?>">
  <link rel="preconnect" href="<?= option('cdn.domain') ?>">
<?php endif ?>

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
  import Lightbox from "<?= url('/assets/js/components/lightbox.js') ?>";
  import Menu from "<?= url('/assets/js/components/menu.js') ?>";
  import Search from "<?= url('/assets/js/components/search.js') ?>";

  new Code();
  new Lightbox();
  new Menu();
  new Search();
</script>

<?= css('assets/css/index.css') ?>

<link rel="icon" type="image/png" href="<?= url('/assets/images/favicon.png') ?>">
<link rel="mask-icon" href="<?= url('/assets/images/safari-mask-icon.svg') ?>" color="#000">
<link href="<?= url('releases.rss') ?>" rel="alternate" type="application/rss+xml" title="Kirby Releases" />
<link href="<?= url('kosmos.rss') ?>" rel="alternate" type="application/rss+xml" title="Kirby Kosmos Archive" />

<?= $meta->robots() ?>
<?= $meta->jsonld() ?>
<?= $meta->opensearch() ?>
<?= $meta->social() ?>
