<?php snippet('header') ?>

  <main class="features-page | main" id="maincontent">
    <article>

      <div class="wrap">
        <?php snippet('hero') ?>
      </div>

      <section id="clients" class="section -background:light">
        <div class="wrap">
          <h2><a href="#clients">For Clients & Agencies</a></h2>

          <ul class="grid">
            <?php foreach ($page->clients()->toStructure() as $item): ?>
            <li class="text">
              <h3 class="-mb:0"><?= $item->headline() ?></h3>
              <?= $item->text()->kt() ?>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </section>

      <section id="editors" class="section">
        <div class="wrap">
          <h2><a href="#editors">For Content editors</a></h2>

          <ul class="grid">
            <?php foreach ($page->editors()->toStructure() as $item): ?>
            <li class="text">
              <h3 class="-mb:0"><?= $item->headline() ?></h3>
              <?= $item->text()->kt() ?>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </section>

      <section id="developers" class="section -background:dark">
        <div class="wrap">
          <h2><a href="#developers">For Developers</a></h2>

          <ul class="grid">
            <?php foreach ($page->developers()->toStructure() as $item): ?>
            <li class="text">
              <h3 class="-mb:0"><?= $item->headline() ?></h3>
              <?= $item->text()->kt() ?>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </section>

      <section id="designers" class="section -background:light">
        <div class="wrap">
          <h2><a href="#designers">For Designers</a></h2>

          <ul class="grid">
            <?php foreach ($page->designers()->toStructure() as $item): ?>
            <li class="text">
              <h3 class="-mb:0"><?= $item->headline() ?></h3>
              <?= $item->text()->kt() ?>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </section>

    </article>
  </main>

<?php snippet('footer') ?>
