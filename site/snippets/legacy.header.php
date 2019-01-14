<!DOCTYPE html>
<html lang="en">
<head>

  <?php snippet('meta') ?>

  <?= css('assets/css/index.css') ?>
  <?= css('assets/css/templates/legacy.css') ?>

</head>
<body data-template="<?= $page->template() ?>">

  <div class="legacy">
    <header class="legacy-header">

      <h1>
        <a href="<?= $page->url() ?>">
          Archive
        </a>
      </h1>

      <nav>
        <?php foreach ($page->siblings() as $version): ?>
        <a href="<?= $version->url() ?>"<?php e($version->isOpen(), ' aria-current') ?>><?= $version->title() ?></a>
        <?php endforeach ?>
        <a href="<?= url('docs') ?>">v3</a>
      </nav>

      <a class="legacy-back" href="<?= url() ?>">
        <svg height="32" viewBox="0 0 46 54" aria-hidden="true">
          <title>Kirby Logo</title>
          <g fill="none" fill-rule="evenodd">
            <path class="logo-hexagon-outline" stroke="#282C34" stroke-width="2" d="M23 7L6 16.66v19.3l17 9.66 17-9.66v-19.3z"></path>
            <path class="logo-hexagon-k" stroke="transparent" fill="transparent" d="M23,7,6,16.66V36l17,9.66L40,36V16.66Zm8,20-5,2.59V30h5v4H15V30h5v-.44L15,27V22l8,4.3L31,22Z"></path>
            <path class="logo-focus-outline" stroke="transparent" stroke-width="2" d="M23 1.84L1.5 14.083v24.46L23 50.786l21.5-12.243v-24.46z"></path>
            <path class="logo-k" fill="#282C34" fill-rule="nonzero" d="M31 27l-5 2.59V30h5v4H15v-4h5v-.437L15 27v-5l8 4.297L31 22"></path>
          </g>
        </svg>
      </a>

    </header>
    <main class="legacy-frame">
