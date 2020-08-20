<?php snippet('reference/header') ?>

<article class="cheatsheet-overview cheatsheet-main cheatsheet-panel">
  <header class="cheatsheet-main-header cheatsheet-panel-header">
    <?php snippet('reference/nav/menu-btn') ?>
  </header>
  <div class="cheatsheet-main-scrollarea cheatsheet-panel-scrollarea">

    <?php foreach ($page->children() as $package): ?>
      <h2 id="<?= $package->slug() ?>">
        <a href="#<?= $package->slug() ?>">
          <?= $package->title() ?>
        </a>
      </h2>

      <section class="-mb:large">
      <ul class="cheatsheet-section-entries">
        <?php foreach ($package->children()->filterBy('isTrait', false) as $class): ?>
        <li>
          <a class="cheatsheet-entry" href="<?= $class->url() ?>">
            <div>
              <strong>
                <span><?= $class->title() ?></span>
              </strong>
            </div>
          </a>
        </li>
        <?php endforeach ?>
      </ul>
      </section>
    <?php endforeach ?>

  </div>
</article>

<?php snippet('reference/footer') ?>
