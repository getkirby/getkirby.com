<?php snippet('header') ?>
<!--style>

.intro-cards {
  display: grid;
  grid-template-columns: repeat(auto-fill,minmax(15rem,1fr));
  grid-gap: 2rem;
  grid-auto-rows: 1fr;
}
</style-->
  <main class="intro-page | main" id="maincontent">

    <div class="wrap">
      <div class="docs-grid">

        <div class="docs-sidebar">
          <p class="h1"><a href="<?= url('docs/guide') ?>">Guide</a></p>
          <?php snippet('sidebar', ['items' => page('docs/guide')->children()]) ?>
        </div>

        <article class="docs-content">
          <header>
            <h1><?= $page->title() ?></h1>
          </header>
          <?php if ($page->intro()->isNotEmpty()): ?>
            <div class="text intro -mb:large">
              <?= $page->intro()->kt() ?>
            </div>
          <?php endif ?> 

          <div class="text -mb:large">
            <?= $page->text()->kt() ?>
          </div>
          <ul class="list intro-cards | -mb:huge">
            <?php foreach ($page->children()->listed() as $item): ?>
          
              <li class="intro-card | -mb:large">
                <a href="<?= $item->url() ?>" class="cardgrid-link">
                  <?php if ($image = $item->images()->findBy('extension', 'svg')): ?>
                    <figure class="-mb:medium"><?= $image->read() ?></figure>
                  <?php endif ?>
                  <h2 class="h5"><?= $item->title()->widont() ?></h2>
                  <p class="description"><?= $item->intro()->kt() ?></p>
                </a>
              </li>
    
            <?php endforeach ?>
          </ul>

        </article>
      </div>
    </div>

  </main>

<?php snippet('footer') ?>
