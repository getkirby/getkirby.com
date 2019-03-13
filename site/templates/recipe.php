<?php snippet('header') ?>

  <main class="docs-page | main" id="maincontent">
    <div class="wrap">
      <div class="docs-grid">
        <!-- # Sidebar -->
        <nav class="docs-sidebar">
          <p class="h1"><a href="<?= url('docs/cookbook') ?>">Cookbook</a></p>
          <?php snippet('sidebar', [ 'items' => page('docs/cookbook')->children()->listed()   ]) ?>
        </nav>

        <!-- # Recipe Content -->
        <article class="docs-content">
          <h1><?= $page->title()->widont() ?></h1>
          <?php snippet('toc', $page->text()->headlines('h2')) ?>
          <div class="text">
            <?= $page->text()->kt()->anchorHeadlines() ?>
          </div>
        </article>
      </div>
    </div>
  </main>

<?php snippet('footer') ?>
