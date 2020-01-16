<?php snippet('header') ?>

<main class="community-page | main" id="maincontent">
  <div class="wrap">

    <header class="community-page-hero hero">
      <h1><?= $page->title() ?></h1>
      <div class="intro -mb:medium">
        <?= $page->intro()->kt() ?>
        <p><a href="https://forum.getkirby.com">forum.getkirby.com</a></p>
      </div>
    </header>

    <!-- # Konf -->
    <div class="section highlight">
      <h2 id="konf" class="h2"><?= $konf->title() ?></h2>
      <div>
        <figure>
          <a href="<?= $konf->url() ?>"><?= $konf->image()->crop(800, 650) ?></a>
        </figure>
        <div class="intro -mb:medium">
          <?= $konf->description()->kt() ?>
          <p><a href="<?= $konf->url() ?>">Find out more</a></p>
        </div>
      </div>
    </div>

    <!-- # Contributors -->
    <div class="section community-contributors">
      <header class="-mb:large">
        <h2 id="contributors" class="h2">Our contributors</h2>
        <p class="intro">
          We are very lucky to have a really supportive group of developers and translators, who build <a href="<?= url('plugins') ?>">plugins</a> and help us test and plan new features for Kirby.
        </p>
      </header>
      <ul>
        <?php foreach ($contributors as $contributor) : ?>
          <li>
            <a href="<?= $contributor->link() ?>" title="<?= $contributor->title() ?>" class="screenshot">
              <span class="intrinsic" style="padding-bottom: 100%">
                <?= $contributor->image()->html(['alt' => $contributor->title()]) ?>
              </span>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>

  </div>
</main>

<?php snippet('footer') ?>
