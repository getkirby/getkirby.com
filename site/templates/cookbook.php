<?php snippet('header') ?>

  <main class="cookbook-page | main" id="maincontent">

    <div class="wrap">

      <header class="hero">
        <h1>Cookbook</h1>
      </header>

      <ul class="cookbook-articles cardgrid">
        <?php foreach($recipes as $item): ?>
        <li class="cardgrid-item" id="<?= $item->slug() ?>">
          <a href="<?= $item->url() ?>" class="cardgrid-link">
            <small class="h6">
              <?= $item->parent()->title() ?>
            </small>
            <h2 class="h5"><?= $item->title()->widont() ?></h2>
            <p class="description">
              <?= $item->description() ?>
            </p>
          </a>
        </li>
        <?php endforeach ?>
      </ul>

    </div>

  </main>

<?php snippet('footer') ?>
