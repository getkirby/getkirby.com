<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

  <?php snippet('meta') ?>

  <?= css('assets/css/index.css') ?>
  <?= css('@auto') ?>

  <?= js('assets/js/index.js', ['defer' => true]) ?>
  <?= js('@auto', ['defer' => true]) ?>

</head>
<body data-template="<?= $page->template() ?>">

  <a href="#maincontent" class="skip-to-content">Skip to content<span aria-hidden="true"> »</span></a>

  <?php if ($page->isHomePage()): ?>
  <div class="producthunt">
    <div class="wrap">
      <a href="https://www.producthunt.com/posts/kirby-3-0">🎉&nbsp;&nbsp;We are currently <strong>#1 product of the day</strong> on <i>Product&nbsp;Hunt</i></a>
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
