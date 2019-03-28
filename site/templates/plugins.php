<?php snippet('header') ?>

<main class="main">

  <div id="plugins" class="wrap">

    <header class="hero">
      <h1><a href="<?= $page->url() ?>">Plugins</a></h1>
      <input class="plugins-search search" placeholder="Search plugins …" />
    </header>

    <div class="plugins-layout">
      <aside class="plugins-sidebar">
        <div class="plugin-filters">
          <h2 class="h6 -mb:medium">Categories</h2>
          <ul class="plugin-categories">
            <?php foreach ($categories as $id => $cat): ?>
            <li<?php e($category === $id, ' aria-current') ?>>
              <a href="?category=<?= $id?>"><span class="plugin-category-icon"><?= icon($cat['icon']) ?></span> <?= $cat['label'] ?></a>
            </li>
            <?php endforeach ?>
          </ul>
        </div>
      </aside>
      <div class="plugins-overview">

        <?php if ($category || $developer): ?>
        <h2 class="h6 -mb:medium">
          <?php e($category, '<small>Category</small>: ' . $category) ?>
          <?php e($developer, '<small>by</small>: ' . $developer) ?>
        </h2>
        <?php snippet('plugins', ['plugins' => $plugins, 'class' => 'plugins-directory']) ?>
        <?php else: ?>

        <h2 class="h6 -mb:medium">All plugins</h2>
        <?php snippet('plugins', ['plugins' => $plugins, 'featured' => false, 'class' => 'plugins-directory']) ?>

        <?php endif ?>

      </div>
    </div>

  </div>

</main>

<?php snippet('footer') ?>
