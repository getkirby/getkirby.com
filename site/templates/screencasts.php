<?php snippet('header') ?>

  <main class="documentation-page | main" id="maincontent">

    <div class="wrap">

      <?php snippet('hero') ?>

      <?php foreach ($page->structure()->yaml() as $categoryTitle => $categoryPages): ?>
      <section>
        <h2 class="h6"><?= $categoryTitle ?></h2>

        <ul class="cardgrid | -mb:huge">
          <?php foreach ($categoryPages as $item): ?>
            <?php if ($item = $page->find($item)): ?>
            <li class="cardgrid-item">
              <a href="<?= $item->link() ?>" class="cardgrid-link">
                <?php if ($image = $item->image()): ?>
                  <figure class="-mb:small"><?= $image ?></figure>
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

      <section>
        <h2 class="h6">More videos …</h2>
        <ul class="cardgrid | -mb:huge">
          <li class="cardgrid-item">
            <p class="description">We are already working on more videos. Stay tuned for updates and subscribe to our channel: <a href="https://youtube.com/kirbycasts">youtube.com/kirbycasts</a></p>
          </li>
        </ul>
      </section>

    </div>

  </main>

<?php snippet('footer') ?>
