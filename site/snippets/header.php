<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

  <?php snippet('meta') ?>

  <?= cachebuster::css('assets/css/index.css') ?>
  <?= cachebuster::css('@auto') ?>

  <?= cachebuster::js('assets/js/index.js', ['defer' => true]) ?>
  <?= cachebuster::js('@auto', ['defer' => true]) ?>

</head>
<body data-template="<?= $page->template() ?>">

  <a href="#maincontent" class="skip-to-content">Skip to content<span aria-hidden="true"> »</span></a>

  <div class="header<?= r(@$background, ' background:' . @$background) ?>">
    <div class="wrap">
      <div class="header-layout">
        <?php snippet('logo') ?>
        <?php snippet('menu', ['background' => @$background ]) ?>
        <?php snippet('search', ['background' => @$background ]) ?>
      </div>
    </div>
  </div>
