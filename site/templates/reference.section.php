<?php snippet('reference/header', ['icons' => $icons ?? null]) ?>

<article class="cheatsheet-section cheatsheet-main cheatsheet-panel">

  <div class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('reference/nav/menu-btn') ?>
  </div>

  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">

    <header class="-mb:large">
      <h2 class="h1"><?= $page->title() ?></h2>

      <?php if ($page->excerpt()->isNotEmpty()): ?>
      <div class="intro">
        <?= $page->excerpt()->kt() ?>
      </div>
      <?php endif ?>

      <?php snippet('reference/entry/meta') ?>
    </header>

    <div class="-mb:large">
      <?php if ($page->children()->hasAdvanced()): ?>
      <?php snippet('reference/list/advanced-link') ?>
      <?php endif ?>
      <?php snippet('reference/list/section', [
        'section' => $page,
        'excerpt' => $excerpt ?? false,
      ]) ?>
    </div>

    <?php if ($page->text()->isNotEmpty()): ?>
    <div class="text">
      <?= $page->text()->kt()->anchorHeadlines() ?>
    </div>
    <?php endif ?>

  </div>

</article>

<?php snippet('reference/footer') ?>
