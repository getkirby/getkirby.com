<?php snippet('cheatsheet.header') ?>

<article class="cheatsheet-overview cheatsheet-main cheatsheet-panel">
  <header class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('cheatsheet.menu.button') ?>
  </header>
  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">

    <?php foreach ($kirby->collection('reference') as $group): ?>
      <h2><?= $group->title() ?></h2>

      <?php foreach ($group->children()->listed() as $section): ?>
      <section class="-mb:large">
        <h3 id="<?= $section->slug() ?>">
          <a href="#<?= $section->slug() ?>">
            <?= $section->title() ?>
          </a>
        </h3>
        <?= $section->svg(); ?>
        <?php
        snippet('cheatsheet.section', [
          'section' => $section
        ]);
        ?>
      </section>
      <?php endforeach ?>
    <?php endforeach ?>

  </div>
</article>

<?php snippet('cheatsheet.footer') ?>
