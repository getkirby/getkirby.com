<?php snippet('header') ?>

  <main class="cookbook-page | main" id="maincontent">

    <div class="wrap" id="cookbook-recipes">

      <header class="hero">
        <h1>Cookbook</h1>
        <input class="cookbook-search search" placeholder="Search recipes …" />
      </header>

      <ul class="cookbook-articles cardgrid list">
        <?php foreach($recipes as $item): ?>
        <li class="cardgrid-item" id="<?= $item->slug() ?>">
          <a href="<?= $item->url() ?>" class="cardgrid-link">
            <small class="h6 cookbook-category">
              <?= $item->parent()->title() ?>
            </small>
            <h2 class="h5 cookbook-title"><?= $item->title()->widont() ?></h2>
            <p class="description cookbook-description">
              <?= $item->description() ?>
            </p>
          </a>
        </li>
        <?php endforeach ?>
      </ul>

    </div>

  </main>

<?php snippet('footer') ?>
