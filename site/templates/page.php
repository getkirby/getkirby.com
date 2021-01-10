<?php snippet('header') ?>

  <main class="docs-page | main" id="maincontent">

    <div class="wrap">
      <div class="docs-grid">

        <!-- # Sidebar -->

        <div class="docs-sidebar">
          <p class="h1"><a href="<?= $root->url() ?>"><?= $root->title() ?></a></p>
          <?php snippet('sidebar', ['items' => $root->children()]) ?>
        </div>

        <!-- # Guide Content -->

        <article class="docs-content">

          <header>
            <h1><?= $page->headline()->or($page->title())->html()->widont() ?></h1>
          </header>

          <?php if ($page->intro()->isNotEmpty()): ?>
          <div class="text intro -mb:large">
            <?= $page->intro()->kt() ?>
          </div>
          <?php endif ?>

          <?php snippet('prose/toc', ['field' => $page->text() ]) ?>

          <div class="text">
            <?= $page->text()->kt()->anchorHeadlines() ?>
          </div>

          <?php if ($page->subpages()->isTrue()): ?>
          <ul class="docs-subpages cheatsheet-grid">
            <?php foreach ($page->children()->listed() as $subpage): ?>
            <li class="cheatsheet-grid-item">
              <a href="<?= $subpage->url() ?>">
                <h4><?= $subpage->title() ?></h4>
                <p><?= $subpage->description() ?></p>
              </a>
            </li>
            <?php endforeach ?>
          </ul>
          <?php endif ?>

        </article>

      </div>
    </div>
  </main>

<?php snippet('footer') ?>
