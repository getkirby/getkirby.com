<?php foreach ($plugins as $plugin): ?>
<article class="mb-6">
  <a href="<?= $plugin->url() ?>" class="bg-dark shadow-xl color-gray-400 rounded overflow-hidden shadow columns" style="--columns: 3; --gap: 0">
    <div class="p-6">
      <h4 class="color-white font-bold"><?= $plugin->title() ?></h4>
      <p class="block font-mono text-xs color-gray-500 mb-3">
        by <span class="color-white"><?= $plugin->parent()->title() ?></span>
      </p>
      <div class="prose color-gray-400 text-sm">
        <?= $plugin->description() ?>
      </div>
    </div>
    <?php if ($image = $plugin->card() ?? $plugin->image()) : ?>
      <img src="<?= $image->url() ?>" class="px-6 pt-6" style="--span: 2; --aspect-ratio: 2/1">
    <?php endif ?>
  </a>
</article>
<?php endforeach ?>
