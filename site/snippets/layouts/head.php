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
<link rel="preconnect" href="https://cdn.paddle.com">
<link rel="preload" href="https://cdn.paddle.com/paddle/paddle.js" as="script">
<?php else: ?>
<link rel="dns-prefetch" href="https://cdn.paddle.com">
<?php endif ?>

<?= $meta->robots() ?>
<?= $meta->jsonld() ?>
<?= $meta->opensearch() ?>
<?= $meta->social() ?>

<?= css('assets/css/index.css') ?>

<script type="module">
window.debounce = (callback, delay) => {
  let timeout;
  return () => {
      clearTimeout(timeout);
      timeout = setTimeout(callback, delay);
  }
}

import "<?= url('/assets/js/polyfills/dialog.js') ?>";

import Affiliates from "<?= url('/assets/js/components/affiliates.js') ?>";
import Code from "<?= url('/assets/js/components/code.js') ?>";
import Lightbox from "<?= url('/assets/js/components/lightbox.js') ?>";
import Menu from "<?= url('/assets/js/components/menu.js') ?>";
import Search from "<?= url('/assets/js/components/search.js') ?>";

new Affiliates();
new Code();
new Lightbox();
new Menu();
new Search();
</script>
