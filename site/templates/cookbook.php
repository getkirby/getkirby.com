<?php snippet('header') ?>

<main class="main">

  <div id="cookbook" class="wrap">

    <header class="hero filter-hero">
      <h1><a href="<?= $page->url() ?>">Cookbook</a></h1>
      <input class="filter-search search" placeholder="Search recipes …" />
    </header>

    <div class="filter-layout">
      <aside class="filter-sidebar">
        <div class="filter-filters">
          <h2 class="h6 -mb:medium">Categories</h2>
          <ul class="filter-categories">
            <?php foreach ($categories as $cat): ?>
            <li<?php e($category === $cat->slug(), ' aria-current') ?>>
              <a href="?category=<?= $cat->slug() ?>"><span class="filter-category-icon"><?= icon($cat->icon()) ?></span> <?= $cat->title() ?></a>
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
          All recipes
          <?php endif ?>
        </h2>
        <?php snippet('recipes', ['recipes' => $recipes]) ?>

      </div>
    </div>

  </div>

</main>

<?php snippet('footer') ?>
