<?php layout('cookbook') ?>

<?php slot('h1') ?>
Author
<?php endslot() ?>

<?php slot() ?>
<figure class="flex max-w-xl mb-12 bg-white py-6 shadow-2xl">
  <div class="px-6" style="width: 200px;">
<p style="--aspect-ratio: 1/1">
    <?= $page->image()->crop(400) ?>
</p>
</div>
  <figcaption class="text-sm leading-tight">
    <p class="h2 mb-1 font-bold"><?= $page->title() ?></p>
    <p class="mb-6 color-gray-700"><?= $page->bio() ?></p>

    <?php if ($page->website()->isNotEmpty()): ?>
    <a href="<?= $page->website() ?>">
      <p class="font-mono link"><?= $page->website()->shortUrl() ?></p>
    </a>
    <?php endif ?>
  </figcaption>
</figure>

<?php snippet('templates/cookbook/recipes', [
  'recipes' => $recipes
]) ?>
<?php endslot() ?>
