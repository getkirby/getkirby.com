<?php snippet('header') ?>

  <main class="archive-page | main" id="maincontent">
    <article class="wrap">

      <?php snippet('hero', ['align' => 'center']) ?>

      <section class="archive">
        <?php foreach ($page->children() as $version): ?>
        <figure>
          <a href="<?= $version->url() ?>" class="screenshot">
            <?= $version->image()->crop(1100, 800, 'top ') ?>
            <figcaption>Kirby Docs <?= $version->title() ?></figcaption>
          </a>
        </figure>
        <?php endforeach ?>
      </section>

    </article>
  </main>

<?php snippet('footer') ?>
