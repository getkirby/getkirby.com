<?php snippet('reference/header') ?>

<article class="cheatsheet-overview cheatsheet-main cheatsheet-panel">
  <header class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('reference/nav/menu-btn') ?>
  </header>

  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">

    <?php foreach ($kirby->collection('cheatsheet') as $group): ?>
      <h2><?= $group->title() ?></h2>

      <?php foreach ($group->children()->listed() as $section): ?>
      <?php snippet('reference/list/section', ['section' => $section]) ?>
      <?php endforeach ?>
    <?php endforeach ?>

  </div>
</article>

<?php snippet('reference/footer') ?>
