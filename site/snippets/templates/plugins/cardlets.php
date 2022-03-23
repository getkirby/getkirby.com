<div class="columns" style="--columns: <?= $columns ?? 3 ?>; --gap: var(--spacing-6)">
  <?php foreach ($plugins as $plugin) : ?>
    <a class="block bg-white rounded overflow-hidden shadow" href="<?= $plugin->url() ?>">
      <article class="columns items-center" style="--columns: 4; --gap: var(--spacing-3)">
        <?php if ($image = $plugin->images()->findBy('name', 'logo')): ?>
          <img class="p-3" src="<?= $image->url() ?>" style="--aspect-ratio: 1/1; object-fit: contain">
        <?php else : ?>
          <figure class="p-3">
            <span class="block bg-light rounded" style="--aspect-ratio: 1/1">
              <span>
                <span class="grid place-items-center" style="height: 100%">
                  <?= icon($plugin->icon()) ?>
                </span>
              </span>
            </span>
          </figure>
        <?php endif ?>
        <div style="--span: 3">
          <h4 class="h5"><?= $plugin->title() ?></h4>
          <p class="font-mono text-xs color-gray-500">
            by <span class="color-black"><?= $plugin->parent()->title() ?></span>
          </p>
        </div>
      </article>
    </a>
  <?php endforeach ?>
</div>
