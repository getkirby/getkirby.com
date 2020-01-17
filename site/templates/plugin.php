<?php snippet('header', [ 'background' => 'dark' ]) ?>

<main class="main" id="maincontent">

  <article class="plugin">

    <header class="hero | -theme:dark">
      <div class="wrap">

        <?php if ($image = $page->images()->findBy('name', 'screenshot')): ?>
        <div class="grid">
          <div class="column">
            <h1><span><?= $page->title() ?></span> Plugin</h1>
            <div class="intro | -theme:dark -mb:large">
              <?= $page->description()->kt() ?>
            </div>
          </div>
          <figure class="column">
            <?= $image ?>
          </figure>
        </div>
        <?php else: ?>
        <h1><span><?= $page->title() ?></span> Plugin</h1>
        <div class="intro | -theme:dark -mb:large">
          <?= $page->description()->kt() ?>
        </div>
        <?php endif ?>

        <nav class="ctas">
          <span>
            <a class="cta" href="<?= $download ?>">
              <?= icon('download') ?>Download <?= $page->version() ?>
            </a>
          </span>

          <span>
            <a class="cta" href="<?= $page->repository() ?>">
              <?= icon('git') ?>Source
            </a>
            <a class="cta" href="<?= $page->repository() ?>">
              <?= icon('guide') ?>Documentation
            </a>
          </span>
        </nav>

      </div>
    </header>

    <div class="-background:light">
      <div class="wrap">
        <nav class="breadcrumb">
          <span>
            <a href="<?= url('plugins') ?>">Plugins</a>
            <a href="<?= url('plugins?category=' . $page->category()) ?>"><?= option('plugins.categories.' . $page->category() . '.label') ?></a>
            <a href="<?= $page->url() ?>"><?= $page->title() ?></a>
          </span>
          <p>by <?= $author->title() ?></p>
        </nav>
      </div>
    </div>

    <?php if ($authorPlugins->count()): ?>
    <section class="section | -background:light">
      <div class="wrap">
        <h2>Other plugins by <?= $author->title() ?></h2>
        <?php snippet('plugins', ['plugins' => $authorPlugins ]) ?>
      </div>
    </section>
    <?php endif ?>

    <?php if ($relatedPlugins->count()): ?>
    <section class="section | -background:light">
      <div class="wrap">
        <h2>Related plugins</h2>
        <?php snippet('plugins', ['plugins' => $relatedPlugins]) ?>
      </div>
    </section>
    <?php endif ?>
  </article>

</main>

<?php snippet('footer', [ 'theme' => 'dark' ]) ?>
