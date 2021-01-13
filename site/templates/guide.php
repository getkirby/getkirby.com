<?php snippet('header') ?>

  <main class="documentation-page | main" id="maincontent">

    <div class="wrap">

      <header class="hero">
        <h1><?= $page->title() ?></h1>
      </header>

      <?php foreach ($page->structure()->yaml() as $categoryTitle => $categoryPages): ?>
      <section>
        <h2 class="h6 -mb:large"><?= $categoryTitle ?></h2>

        <ul class="cardgrid | -mb:huge">
          <?php foreach ($categoryPages as $item): ?>
            <?php if ($item = $page->find($item)): ?>
            <li class="cardgrid-item">
              <a href="<?= $item->url() ?>" class="cardgrid-link">
                <?php if ($image = $item->images()->findBy('extension', 'svg')): ?>
                  <figure class="-mb:medium"><?= $image->read() ?></figure>
                <?php endif ?>
                <h2 class="h5"><?= $item->title()->widont() ?></h2>
                <p class="description"><?= $item->description() ?></p>
              </a>
            </li>
            <?php endif ?>
          <?php endforeach ?>
        </ul>

      </section>
      <?php endforeach ?>

    </div>

  </main>

<?php snippet('footer') ?>
