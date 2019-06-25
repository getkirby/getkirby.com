<?php if (!get('plain')): ?>

<?php snippet('cheatsheet.header', ['icons' => $icons ?? null]) ?>
<?php snippet('cheatsheet.entries', ['entries' => $page->siblings()->forCheatsheet()]) ?>

<article class="cheatsheet-article cheatsheet-main cheatsheet-panel">
<?php endif ?>

  <div class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('cheatsheet.menu.button') ?>
    <button data-show="entries">
      <svg viewBox="0 0 12 12" width="12" height="12" aria-hidden="true"><path d="M10,0H2A2,2,0,0,0,0,2v8a2,2,0,0,0,2,2h8a2,2,0,0,0,2-2V2A2,2,0,0,0,10,0ZM7,2V4H2V2ZM7,7H2V5H7ZM2,8H7v2H2Zm6,2V2h2v8Z"></path></svg>Overview
    </button>
  </div>

  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">
    <div class="cheatsheet-article-content">
      <header class="-mb:medium">
          <h2 class="h1"><?= $page->title() ?></h2>

          <?php if ($page->excerpt()->isNotEmpty()): ?>
          <div class="intro">
            <?= $page->excerpt()->kt() ?>
          </div>
          <?php endif ?>

          <?php snippet('cheatsheet.article.meta') ?>
        </header>
        
        <?php if ($page->deprecated()->isNotEmpty()): ?>
        <?php snippet('cheatsheet.article.deprecated', ['deprecated' => $page->deprecated()->split('|')]) ?>
        <?php endif ?>
        
