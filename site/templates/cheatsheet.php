<?php snippet('cheatsheet.header') ?>

<article class="cheatsheet-overview cheatsheet-main cheatsheet-panel">
  <header class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('cheatsheet.menu.button') ?>
  </header>
  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">

    <?php foreach (option('cheatsheet') as $groupName => $groupPages): ?>
      <?php foreach ($page->children()->listed()->find(...$groupPages) as $section): ?>
      <section class="-mb:large">
        <h2 id="<?= $section->slug() ?>"><a href="#<?= $section->slug() ?>"><?= $section->title() ?></a></h2>
        <?php snippet('cheatsheet.section', ['section' => $section]) ?>
      </section>
      <?php endforeach ?>
    <?php endforeach ?>

  </div>
</article>

<?php snippet('cheatsheet.footer') ?>
