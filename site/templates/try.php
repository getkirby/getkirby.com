<?php snippet('header') ?>

  <main class="try-page | main" id="maincontent">
    <article class="wrap">

      <header class="hero -align:center">
        <h1>Try Kirby for free</h1>
        <div class="intro">
          <?= $page->intro()->kt() ?>
        </div>
      </header>


      <div class="downloads -mb:huge -align:center">
        <?php foreach ($page->downloads()->toStructure() as $download) : ?>
        <p>
          <?php snippet('cta', [
            'link' => $download->link(),
            'text' => $download->text(),
            'icon' => 'download',
          ]) ?>
          <?= $download->description() ?>
        </p>
        <?php endforeach ?>
      </div>

      <figure class="starterkit">
        <a href="https://download.getkirby.com" class="intrinsic" style="padding-bottom: 164.5%">
          <?= $page->image('starterkit.jpg')->resize(800)->html(['alt' => 'The home page of Kirby\'s starterkit']) ?>
        </a>
      </figure>

      <div class="text description">
        <?= $page->text()->kt() ?>
      </div>

    </article>
  </main>

<?php snippet('footer') ?>
