<?php snippet('header') ?>

  <main class="glossary-page | main" id="maincontent">

    <div class="wrap">

      <header class="hero">
        <h1><?= $page->title() ?></h1>
      </header>

      <div class="cardgrid">
        <?php foreach ($items as $term): ?>
        <article id="<?= $term->slug() ?>">
          <a href="<?= $term->link()->toUrl() ?>">
            <h3 class="h5"><?= $term->title() ?></h3>
            <div class="text description">
              <?= $term->entry()->kt() ?>
            </div>
          </a>
        </article>
        <?php endforeach ?>
      </div>

    </div>

  </main>

<?php snippet('footer') ?>
