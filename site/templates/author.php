<?php layout('cookbook') ?>

<?php slot('hero') ?>
<header class="mb-6 flex">
  <h1 class="h1 mr-3"><?= $page->title() ?></h1>
  <div style="width: 3.5rem;">
    <?= $page->image()->crop(400) ?>
  </div>
</header>
<?php endslot() ?>

<?php slot() ?>

<div class="mb-24">
  <span class="pill">
    <span class="mr-3"><?= icon('user') ?></span><?= $page->bio() ?>
  </span>

  <a href="<?= $page->website() ?>" class="pill">
    <span class="mr-3"><?= icon('globe') ?></span>
    <span class="link"><?= $page->website()->shortUrl() ?></span>
  </a>
</div>

<h2 class="pill mb-6"><span class="mr-3"><?= icon('book') ?></span>All recipes</h2>

<?php snippet('templates/cookbook/recipes', [
  'recipes' => $recipes
]) ?>
<?php endslot() ?>
