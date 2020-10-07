<?php snippet('header') ?>

  <main class="documentation-page | main" id="maincontent">

    <div class="wrap">

      <?php snippet('hero') ?>

      <?php foreach ($page->children()->listed() as $category): ?>
      <section>
        <h2 class="h6" id="<?= $category->slug() ?>"><?= $category->title() ?></h2>

        <ul class="cardgrid | -mb:huge">
          <?php foreach ($category->children()->listed() as $screencast): ?>
          <li class="cardgrid-item">
            <a href="<?= $screencast->link() ?>" class="cardgrid-link">
              <?php if ($image = $screencast->image()): ?>
                <figure class="-mb:small"><?= $image ?></figure>
              <?php endif ?>
              <h2 class="h5"><?= $screencast->title()->widont() ?></h2>
              <p class="description"><?= $screencast->description() ?></p>
            </a>
          </li>
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
