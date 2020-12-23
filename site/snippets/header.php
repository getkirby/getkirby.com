<!DOCTYPE html>
<html class="no-js" lang="en" prefix="og: http://ogp.me/ns#">
<head>
<?php snippet('meta') ?>

<?= css('assets/css/index.css') ?>
<?= css('@auto') ?>

<!--  Replace `no-js` class in root element with `js` -->
<script>(function(cl){cl.remove('no-js');cl.add('js');})(document.documentElement.classList);</script>

<?php if (option('keycdn', false) !== false): ?>
  <script>
  window.kirbyConfig = {
    assetsPath: "<?= addslashes(option('keycdn.domain')) ?>/assets/",
  };
  </script>
<?php endif ?>

<?= js('assets/js/index.js', ['defer' => true]) ?>
<?= js(['assets/js/site.js', '@auto'], ['type' => 'module']) ?>


</head>
<body data-template="<?= $page->template() ?>">

  <?php if (@$skipLink !== false): ?>
    <a href="#maincontent" class="skip-to-content">Skip to content<span aria-hidden="true"> »</span></a>
  <?php endif ?>

  <?php if ($page->isHomePage()): ?>
  <div class="producthunt">
    <div class="wrap">
      <?php if (option('sale')): ?>
      <a href="<?= url('buy') ?>">🛍&nbsp;&nbsp;<?= option('sale.banner') ?></a>
      <?php else: ?>
      <a href="https://www.producthunt.com/posts/kirby-3-0">🎉&nbsp;&nbsp;Featured as <strong>#1 product of the day</strong> on <i>Product&nbsp;Hunt</i></a>
      <?php endif ?>
    </div>
  </div>

  <style>
    .producthunt {
      color: #fff;
      border-bottom: 1px solid rgba(255,255,255, .2);
      text-align: center;
    }
    .producthunt a {
      display: block;
      padding: .5rem 0;
    }
    .producthunt a strong {
      font-weight: 400;
      color: #f0c675;
    }
    .producthunt a i {
      text-decoration: underline;
      font-style: normal;
    }
    .header {
      position: static;
      margin-bottom: -6rem;
    }
  </style>
  <?php endif ?>

  <div class="header<?= r(@$background, ' background:' . @$background) ?>" role="banner">
    <div class="wrap">
      <div class="header-layout">
        <?php snippet('logo') ?>
        <?php snippet('menu', ['background' => @$background ]) ?>
        <?php snippet('search', ['background' => @$background ]) ?>
      </div>
    </div>
  </div>
