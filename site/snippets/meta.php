<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<meta property="og:image" content="<?= cachebuster::url('assets/images/opengraph.jpg') ?>" />

<link rel="icon" type="image/png" href="<?= cachebuster::url('favicon.png') ?>">
<link rel="mask-icon" href="<?= cachebuster::url('safari-mask-icon.svg') ?>" color="#16171a">

<title>
  <?= $page->isHomePage() ? $site->title() . ' | ' . $site->description() : $page->title() . ' | ' . $site->title() ?>
</title>

<link rel="preload" href="<?= cachebuster::url('assets/css/index.css') ?>" as="style">
<link rel="preload" href="<?= cachebuster::url('assets/js/index.js') ?>" as="script">

<?php if ($page->template()->name() === 'buy'): ?>
<link rel="preload" href="https://cdn.paddle.com/paddle/paddle.js" as="script">
<?php endif ?>

<!--  Replace `no-js` class in root element with `js` -->
<script>(function(cl){cl.remove('no-js');cl.add('js');})(document.documentElement.classList);</script>

<!-- Polyfills -->
<script>
(function(w, d) {
  function loadJS(url, async){var r=d.getElementsByTagName("script")[0],s=d.createElement("script");if(async)s.async=true;s.src=url;r.parentNode.insertBefore(s,r);}

  // Promise polyfill for IE 11
  if(!window.Promise) {
    loadJS('<?= cachebuster::url('assets/js/polyfills/promise.js') ?>');
  }
})(window, document);
</script>
