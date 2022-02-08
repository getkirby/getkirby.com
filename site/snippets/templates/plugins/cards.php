<div class="columns" style="--columns: <?= $columns ?? 3 ?>; --gap: var(--spacing-6)">
  <?php foreach ($plugins as $plugin) : ?>
  <a class="block bg-white rounded overflow-hidden shadow" href="<?= $plugin->url() ?>">
    <article>
      <figure class="bg-light">
        <?php if ($card = $plugin->card()): ?>
        <img src="<?= $card->url() ?>" style="--aspect-ratio: 4/3; object-position: left top;">
        <?php endif ?>
      </figure>
      <div class="p-6">
        <header class="mb-3">
          <h4 class="h5"><?= $plugin->title() ?></h4>
          <p class="font-mono text-xs color-gray-500">
            by <span class="color-black"><?= $plugin->parent()->title() ?></span>
          </p>
        </header>
        <div class="prose text-sm">
          <?= $plugin->description() ?>
        </div>
      </div>
    </article>
  </a>
  <?php endforeach ?>
</div>
