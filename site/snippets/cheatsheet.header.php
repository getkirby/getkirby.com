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
          <label for="cheatsheet-search">
            <span class="screen-reader-text">Search</span>
            <?php icon('search', false, ['aria-hidden' => 'true']) ?>
          </label>
          <input
            id="cheatsheet-search"
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
