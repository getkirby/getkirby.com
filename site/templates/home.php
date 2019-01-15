<?php snippet('header', [ 'floating' => true, 'background' => 'dark' ]) ?>

  <main class="home-page | main" id="maincontent">

    <!-- # Hero Section -->
    <header class="home-hero">
      <div class="wrap">
        <div class="home-hero-banner">
          <h1>Kirby is the content&nbsp;management system that adapts to your projects like no other</h1>
          <figure>
            <span class="intrinsic" style="padding-bottom: 96.82%">
              <img
                srcset="
                  <?= $chameleon->resize(450)->url() ?>,
                  <?= $chameleon->resize(800)->url() ?> 2x
                "
                src="<?= $chameleon->resize(450)->url() ?>"
                alt="A cute chameleon on a branch"
              >
            </span>
          </figure>
        </div>
        <figure class="home-hero-screenshot">
          <span class="intrinsic" style="padding-bottom: 45.39%">
            <img
              srcset="
                <?= $hero->resize(1024)->url() ?>,
                <?= $hero->resize(1600)->url() ?> 2x
              "
              src="<?= $hero->resize(1024)->url() ?>"
              alt="Screenshot of Kirby\'s control panel"
            >
          </span>
        </figure>
      </div>
    </header>

    <section id="blueprints" class="home-blueprints -background:light">
      <h2 class="visually-hidden">You define the interface for your content</h2>
      <div class="wrap">
        <p class="h2">
          With Kirby, you build your own
          ideal interface. Combine forms, galleries, articles, spreadsheets
          and more into an amazing editing experience.
        </p>
        <figure>
          <span class="intrinsic" style="padding-bottom: 59.12%">
            <img
              srcset="
                <?= $components->resize(1200)->url() ?>,
                <?= $components->resize(2000)->url() ?> 2x
              "
              src="<?= $components->resize(1200)->url() ?>"
              alt="Interface elements for Kirby\'s control panel"
            >
          </span>
        </figure>
      </div>
    </section>

    <!-- # Panel -->
    <section id="panel" class="home-panel -background:light">
      <h2 class="visually-hidden">Kirby’s control panel</h2>
      <div class="wrap">
        <div class="home-panel-container">
          <div class="home-panel-gallery">
            <?php if ($firstImage = $page->images()->filterBy('name', '*=', 'interface')->nth(2)): ?>
            <figure class="screenshot">
              <span class="intrinsic" style="padding-bottom: 67%">
                <img src="<?= $firstImage->resize(1440)->url() ?>" alt="<?= $firstImage->caption() ?>">
              </span>
            </figure>
            <?php endif ?>
          </div>

          <ul class="home-panel-gallery-links">
            <?php $n = 0; foreach ($page->images()->filterBy('name', '*=', 'interface') as $image): $n++; ?>
            <li>
              <a href="<?= $imageUrl = $image->resize(1440)->url() ?>"<?php e($image->is($firstImage), ' aria-current="true"') ?>>
                <figure>
                  <span class="intrinsic" style="padding-bottom: 67%">
                    <img src="<?= $imageUrl ?>" alt="">
                  </span>
                  <figcaption>
                    <h3 class="h6 -color:white -mb:small"><?= $image->caption() ?></h3>
                    <p><?= $image->description() ?></p>
                  </figcaption>
                </figure>
              </a>
            </li>
            <?php endforeach ?>
          </ul>

        </div>
      </div>
    </section>

    <!-- # Plugins -->
    <section id="plugins" class="home-plugins | section | -background:light">
      <h2 class="visually-hidden">Plugins</h2>
      <div class="wrap">
        <header>
          <p class="h2">And if you ever run out of ideas or possibilities? <a href="<?= url('community') ?>">Get a plugin</a> or build your own interface elements.</p>
          <p class="description">…like this fantastic <a href="https://github.com/sylvainjule/kirby-matomo">Matomo plugin</a><br> by <a href="https://sylvain-jule.fr">Sylvain Julé</a> &rsaquo;</p>
        </header>
        <figure>
          <a href="https://github.com/sylvainjule/kirby-matomo" class="intrinsic" style="padding-bottom: 126.89%">
            <img
              srcset="
                <?= $matomo->resize(600)->url() ?>,
                <?= $matomo->resize(1200)->url() ?> 2x
              "
              src="<?= $matomo->resize(600)->url() ?>"
              alt="Screenshot of the Matomo plugin by Sylvain Julé"
            >
          </a>
        </figure>
      </div>
    </section>

    <!-- # Highlights -->
    <section id="highlights" class="home-highlights">
      <h2 class="visually-hidden">Highlights</h2>
      <div class="wrap">
        <div class="home-highlights-grid">
          <div>
            <h3 class="h2">
              Just files and folders
            </h3>

            <?= $page->filesystem()->kt() ?>

            <ul class="home-highlights-features">
              <li><?= icon('check') ?> Drag & Drop installation via FTP</li>
              <li><?= icon('check') ?> Very robust and easy to back up</li>
              <li><?= icon('check') ?> Simple version control via Git</li>
              <li><?= icon('check') ?> Incredible performance</li>
              <li><?= icon('check') ?> Super fast development process</li>
            </ul>
          </div>
          <div>
            <h3 class="h2">
              Your markup on fire
            </h3>

            <?= $page->templates()->kt() ?>

            <ul class="home-highlights-features">
              <li><?= icon('check') ?> High-performance PHP template engine</li>
              <li><?= icon('check') ?> Powerful chainable PHP API</li>
              <li><?= icon('check') ?> Combine data from everywhere on your site</li>
              <li><?= icon('check') ?> Built-in image manipulation</li>
              <li><?= icon('check') ?> Replaceable template engine (bring your own engine)</li>
            </ul>
          </div>
        </div>

      </div>
    </section>

    <!-- # Features -->
    <section id="features" class="home-features | section">
      <h2 class="visually-hidden">Features</h2>
      <div class="wrap">
        <ul>
          <?php foreach($page->find('features')->children() as $feature): ?>
            <li>
              <figure>
                <?= $feature->image()->read() ?>
              </figure>
              <h3><?= $feature->title() ?></h3>
              <div class="description"><?= $feature->text()->kt() ?></div>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </section>


    <div class="-background:light">

      <!-- # Voices -->
      <section id="voices" class="home-voices section">
        <div class="wrap">
          <h2 class="h2">
            Don't take our word for it:
          </h2>

          <?php snippet('voices') ?>
        </div>
      </section>

      <section id="customers">
        <div class="wrap">
          <h2 class="visually-hidden">Kirby is trusted by brands world-wide</h2>
          <?php snippet('clients') ?>
        </div>
      </section>

      <!-- # Actions -->
      <section id="try" class="home-actions | section">
        <h2 class="visually-hidden">Get started</h2>
        <a href="<?= url('try') ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="nc-icon-wrapper" fill="#111111"><path fill="#111111" d="M12.707,22.707L20.414,15L19,13.586l-6,6V2c0-0.553-0.448-1-1-1s-1,0.447-1,1v17.586l-6-6L3.586,15 l7.707,7.707C11.684,23.098,12.316,23.098,12.707,22.707z"></path></g></svg>
          Try Kirby 3 now
        </a>
        <a href="<?= url('buy') ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g class="nc-icon-wrapper" fill="#111111"><circle data-color="color-2" cx="6.5" cy="21.5" r="2.5"></circle> <circle data-color="color-2" cx="19.5" cy="21.5" r="2.5"></circle> <path fill="#111111" d="M20,17H6c-0.501,0-0.925-0.371-0.991-0.868L3.125,2H0V0h4c0.501,0,0.925,0.371,0.991,0.868L5.542,5H23 c0.316,0,0.614,0.149,0.802,0.403c0.189,0.254,0.247,0.582,0.156,0.884l-3,10C20.831,16.71,20.441,17,20,17z"></path></g></svg>
          Buy a license
        </a>
      </section>

    </div>

    <!-- # Newsletter -->
    <section id="kosmos" class="home-kosmos">
      <div class="wrap">
        <div class="home-kosmos-form">
          <h2 class="h2 -mb:large">We publish a monthly newsletter called Kosmos with all kinds of news about <a href="<?= url('kosmos') ?>">Kirby and the web</a>.</h2>
          <?php snippet('kosmos-form') ?>
        </div>
      </div>
    </section>

</main>

<script>
var $ = function(selector) {
  return document.querySelector(selector);
};

var $$ = function(selector) {
  return [].slice.call(document.querySelectorAll(selector));
};

var galleryImage = $(".home-panel-gallery img");
var galleryLinks = $$('.home-panel-gallery-links a');

galleryLinks.forEach(function (galleryLink) {
  galleryLink.addEventListener("click", function (e) {
    e.preventDefault();
    $('.home-panel-gallery-links a[aria-current]').removeAttribute('aria-current');
    galleryImage.src = this.href;
    galleryLink.setAttribute("aria-current", true);
  }, true);
});
</script>

<?php snippet('footer', ['theme' => 'dark']) ?>
