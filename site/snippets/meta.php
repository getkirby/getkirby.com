<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Kirby is the content management system that adapts to your projects like no other">
<meta property="og:image" content="<?= page('press')->image('opengraph.jpg')->url() ?>" />

<?php if (option('beta')): ?>
<meta name="robots" content="noindex, nofollow">
<?php endif ?>

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

<link rel="preload" href="<?= url('assets/css/index.css') ?>" as="style">
<link rel="preload" href="<?= url('assets/js/index.js') ?>" as="script">

<?php if ($page->template()->name() === 'buy'): ?>
<link rel="preload" href="https://cdn.paddle.com/paddle/paddle.js" as="script">
<?php else: ?>
<link rel="dns-prefetch" href="https://cdn.paddle.com">
<link rel="preconnect" href="https://cdn.paddle.com">
<?php endif ?>

<!--  Replace `no-js` class in root element with `js` -->
<script>(function(cl){cl.remove('no-js');cl.add('js');})(document.documentElement.classList);</script>

<!-- Polyfills -->
<script>
(function(w, d) {
  function loadJS(url, async){var r=d.getElementsByTagName("script")[0],s=d.createElement("script");if(async)s.async=true;s.src=url;r.parentNode.insertBefore(s,r);}

  // Promise polyfill for IE 11
  if(!window.Promise) {
    loadJS('<?= url('assets/js/polyfills/promise.js') ?>');
  }
})(window, document);
</script>
