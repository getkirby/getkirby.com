<?php snippet('header') ?>

  <main class="archive-page | main" id="maincontent">
    <article class="wrap">

      <?php snippet('hero', ['align' => 'center']) ?>

      <section class="archive">
        <?php foreach ($page->children() as $version): ?>
        <figure>
          <a href="<?= $version->src() ?>" class="screenshot">
            <?= $version->image()->crop(1100, 800, 'top ') ?>
          </a>
          <figcaption>
            <a href="<?= $version->src() ?>">
              <p><strong>Kirby Docs <?= $version->title() ?></strong></p>
              <?= $version->description()->kt() ?>
            </a>
            <dl>
              <a href="<?= $version->src() ?>">
                <dt>Docs</dt>
                <dd><?= $version->src() ?></dd>
              </a>
              <a href="<?= $version->github() ?>">
                <dt>Source:</dt>
                <dd><?= $version->github() ?></dd>
              </a>
            </dl>
          </figcaption>
        </figure>
        <?php endforeach ?>
      </section>

    </article>
  </main>

<?php snippet('footer') ?>
