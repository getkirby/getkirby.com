<?php snippet('header', [ 'floating' => true, 'background' => 'dark' ]) ?>

  <main class="home-page | main" id="maincontent">

    <!-- # Hero Section -->
    <header class="home-hero">
      <div class="wrap">
        <div class="home-hero-banner">
          <h1>Kirby is the content&nbsp;management system that adapts to your projects like no other</h1>
          <figure>
            <?= $page->image('chameleon.jpg') ?>
          </figure>
        </div>
        <figure class="home-hero-screenshot">
          <?= $page->image('hero.jpg')->html(['alt' => 'Screenshot of Kirby\'s control panel']) ?>
        </figure>
      </div>
    </header>

    <section class="home-blueprints -background:light">
      <div class="wrap">
        <p class="h2">
          With Kirby, you build your own
          ideal interface. Combine forms, galleries, articles, spreadsheets
          and more into an amazing editing experience.
        </p>
        <figure>
          <?= $page->image('components.jpg', ['alt' => 'Interface elements for Kirby\'s control panel']) ?>
        </figure>
      </div>
    </section>



    <!-- # Panel -->
    <section class="home-panel -background:light">
      <div class="wrap">
        <div class="home-panel-container">
          <div class="home-panel-gallery">
            <figure class="screenshot">
              <img src="<?= $page->images()->filterBy('name', '*=', 'interface')->first()->crop(1400, 900, 'top')->url() ?>">
            </figure>
          </div>

          <ul class="home-panel-gallery-links">
            <?php $n = 0; foreach ($page->images()->filterBy('name', '*=', 'interface') as $image): $n++; ?>
            <li>
              <a href="<?= $image->crop(1400, 900, 'top')->url() ?>"<?php e($n === 1, ' aria-current="item"') ?>>
                <figure>
                  <span>
                    <?= $image->crop(1400, 900, 'top') ?>
                  </span>
                  <figcaption>
                    <h4 class="h6 -color:white"><?= $image->caption() ?></h4>
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
    <section class="home-plugins | section | -background:light">
      <div class="wrap">
        <header>
          <h2 id="plugins" class="h2">And if you ever run out of ideas or possibilities? <a href="<?= url('community') ?>">Get a plugin</a> or build your own interface elements.</h2>
          <p class="description">…like this fantastic <a href="https://github.com/sylvainjule/kirby-matomo">Matomo plugin</a><br> by <a href="https://sylvain-jule.fr">Sylvain Julé</a> &rsaquo;</p>
        </header>
        <figure>
          <a href="https://github.com/sylvainjule/kirby-matomo">
            <?= $page->image('matomo.jpg')->html(['alt' => 'Screenshot of the Matomo plugin by Sylvain Julé']) ?>
          </a>
        </figure>
      </div>
    </section>

    <!-- # Highlights -->
    <section class="home-highlights">
      <div class="wrap">
        <div class="home-highlights-grid">
          <div>
            <h2 class="h2">
              Just files and folders
            </h2>

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
            <h2 class="h2">
              Your markup on fire
            </h2>

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
    <section class="home-features | section">
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

      <section id="clients">
        <div class="wrap">
          <?php snippet('clients') ?>
        </div>
      </section>

      <!-- # Actions -->
      <section id="try" class="home-actions | section">

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
    galleryLink.setAttribute("aria-current", "item");
  }, true);
});
</script>

<?php snippet('footer', ['theme' => 'dark']) ?>
