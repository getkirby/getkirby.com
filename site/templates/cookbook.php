<?php snippet('header') ?>

<main class="main" id="maincontent">

  <div id="cookbook" class="wrap">

    <header class="hero filter-hero">
      <h1><a href="<?= $page->url() ?>">Cookbook</a></h1>
      <input class="filter-search search" placeholder="Search recipes …" />
    </header>

    <div class="filter-layout">
      <aside class="filter-sidebar">
        <div class="filter-filters">
          <ul class="filter-categories">
            <li>
              <a href="<?= $page->url() ?>"><span class="filter-category-icon"><?= icon('list') ?></span> All recipes</a>
            </li>
            <li>
              <a href="?new=true"><span class="filter-category-icon"><?= icon('star-outline') ?></span> New recipes</a>
            </li>
          </ul>

          <h2 class="h6 -mb:medium">Categories</h2>
          <ul class="filter-categories">
            <?php foreach ($categories as $cat): ?>
            <li<?php e($category === $cat->slug(), ' aria-current') ?>>
              <a href="?category=<?= $cat->slug() ?>">
                <span class="filter-category-icon"><?= icon($cat->icon()) ?></span> <?= $cat->title() ?>
              </a>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </aside>
      <div class="filter-overview">
        <h2 class="h6 -mb:medium">
          <?php if ($category): ?>
          <?php e($category, '<small>Category</small>: ' . $category->title()) ?>
          <?php else: ?>
          <?= e(get('new'), 'New', 'All') ?> recipes
          <?php endif ?>
        </h2>
        
        <ul class="list recipe-cards">
          <?php foreach ($recipes as $recipe): ?>
          <li class="recipe-card" data-filter="<?= htmlspecialchars($recipe->title()) ?> <?= htmlspecialchars($recipe->description()) ?>">
            <a class="recipe-card-body" href="<?= $recipe->url() ?>">
              <h3 class="recipe-card-title">
                <span><?= $recipe->title() ?></span>

                <?php if ($recipe->isNew()): ?>
                <code class="cookbook-new">New</code>
                <?php endif ?>
              </h3>

              <p class="recipe-card-description">
                <?= $recipe->description()->widont() ?>
              </p>
            </a>
            <footer class="recipe-card-footer">
              <?php foreach ($recipe->categories() as $category) : ?>
              <a href="<?= $category->url() ?>"><?= icon($category->icon()) ?>
              <?= $category->title() ?></a>
              <?php endforeach ?>
            </footer>
          </li>
          <?php endforeach ?>
        </ul>

      </div>
    </div>

  </div>

</main>

<?php snippet('footer') ?>
