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

      <?php if ($guide = page('docs/guide')) : ?>
      <a class="cheatsheet-back" href="<?= $guide->url() ?>">
        <svg width="23" height="26" aria-hidden="true">
          <g fill="#FFF" fill-rule="nonzero">
            <path d="M11.5 1.119L1 7.085v11.938l10.5 5.966L22 19.023V7.085L11.5 1.12zm9.333 17.225L11.5 23.647l-9.333-5.303V7.764L11.5 2.461l9.333 5.303v10.58z"></path>
            <path d="M6.863 10v2.89l2.889 1.481v.252H6.863v2.312h9.246v-2.312H13.22v-.237l2.889-1.496V10l-4.623 2.483z"></path>
          </g>
        </svg>
        <span>Guide</span>
      </a>
      <?php endif ?>

    </header>
    <main class="cheatsheet-panels">
      <?php snippet('cheatsheet.sections') ?>
