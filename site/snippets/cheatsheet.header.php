<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

  <?php snippet('meta') ?>

  <?= css('assets/css/index.css') ?>
  <?= css('assets/css/templates/cheatsheet.css') ?>
  <?= css('@auto') ?>

  <?= js('assets/js/index.js', ['defer' => true]) ?>
  <?= js('assets/js/templates/cheatsheet.js', ['defer' => true]) ?>

</head>
<body data-template="<?= $page->template() ?>">

  <?= $icons ?? null ?>

  <div class="cheatsheet">
    <header class="cheatsheet-header">

      <h1>
        <a href="<?= url('docs/reference') ?>">
          Reference
        </a>
      </h1>

      <form class="js-menu-search" action="<?= u('search') ?>" data-base-url="<?= u() ?>">
          <svg viewBox="0 0 16 16" width="16" height="16"><g><path d="M15.707,13.293L13,10.586c0.63-1.05,1-2.275,1-3.586c0-3.86-3.141-7-7-7S0,3.14,0,7s3.141,7,7,7 c1.312,0,2.536-0.369,3.586-1l2.707,2.707C13.488,15.902,13.744,16,14,16s0.512-0.098,0.707-0.293l1-1 C16.098,14.316,16.098,13.684,15.707,13.293z M7,12c-2.761,0-5-2.239-5-5s2.239-5,5-5s5,2.239,5,5S9.761,12,7,12z"></path></g></svg>
          <input
            class="js-menu-search-input"
            placeholder="Search …"
            data-filters="area:reference"
            name="q"
            autocomplete="off"
            aria-autocomplete="list"
            type="search">
      </form>

      <a class="cheatsheet-back" href="<?= url() ?>">
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
    <main class="cheatsheet-panels">
      <?php snippet('cheatsheet.sections') ?>
