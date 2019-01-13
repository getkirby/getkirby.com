<?php snippet('header') ?>

  <main class="contact-page | main" id="maincontent">
    <div class="wrap">
      <article class="contact-grid">
        <section>
          <header class="hero">
            <h1>Contact</h1>
          </header>
          <div class="text">
            <?= $page->contact()->kt() ?>
          </div>
        </section>
        <section>
          <header class="hero">
            <h2 class="h1">Disclaimer</h2>
          </header>
          <div class="text">
            <?= $page->disclaimer()->kt() ?>
          </div>
        </section>
      </article>
    </div>
  </main>

<?php snippet('footer') ?>
