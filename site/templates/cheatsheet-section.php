<?php snippet('cheatsheet.header') ?>

<article class="cheatsheet-section cheatsheet-main cheatsheet-panel">

  <div class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('cheatsheet.menu.button') ?>
  </div>

  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">

    <header class="-mb:large">
      <h2 class="h1"><?= $page->title() ?></h2>

      <?php if ($page->excerpt()->isNotEmpty()): ?>
      <div class="intro">
        <?= $page->excerpt()->kt() ?>
      </div>
      <?php endif ?>
      
      <?php snippet('cheatsheet.section.advanced-link') ?>
    </header>

    <div class="-mb:large">
      <?php snippet('cheatsheet.section', ['section' => $page]) ?>
    </div>

    <?php if ($page->text()->isNotEmpty()): ?>
    <div class="text">
      <?= $page->text()->kt()->anchorHeadlines() ?>
    </div>
    <?php endif ?>

  </div>

</article>

<?php snippet('cheatsheet.footer') ?>
