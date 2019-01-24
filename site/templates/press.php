<?php snippet('header') ?>

  <main class="press-page | main" id="maincontent">
    <article class="wrap">

      <header class="hero | -align:center -mb:huge">
        <h1><?= $page->title() ?></h1>
        <div class="intro | -theme:<?= $theme ?? 'white' ?>">
          <?= $page->intro()->widont()->kt() ?>
          <p><a href="<?= $page->file('kirby-3-presskit.zip')->url() ?>" download>Get the press kit</a></p>
        </div>
      </header>

      <section class="logos">
        <h2 class="h3 -align:center">Logo</h2>
        <ul>
          <?php foreach ($page->images()->filterBy('extension', 'svg') as $logo): ?>
          <li>
            <a href="<?= $logo->url() ?>" download>
              <figure>
                <span>
                  <?= $logo->read() ?>
                </span>
                <figcaption>
                  <strong><?= $logo->filename() ?></strong>
                  <small><?= $logo->niceSize() ?></small>
                </figcaption>
              </figure>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
      </section>

      <section class="screenshots">
        <h2 class="h3 -align:center">Screenshots</h2>
        <ul>
          <?php foreach ($page->images()->filterBy('extension', 'png') as $screenshot): ?>
          <li><a href="<?= $screenshot->resize(1400)->url() ?>" download><?= $screenshot ?></a></li>
          <?php endforeach ?>
        </ul>
      </section>

    </article>
  </main>

<?php snippet('footer') ?>
