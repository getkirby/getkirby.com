<div class="columns" style="--columns: <?= $columns ?? 2 ?>; --gap: var(--spacing-6)">
  <?php foreach ($plugins as $plugin) : ?>
    <a class="block bg-white rounded overflow-hidden shadow" href="<?= $plugin->url() ?>">
      <article class="flex items-center">
        <figure class="mr-3 p-3" style="width: 6rem">
          <div class="block rounded" style="--aspect-ratio: 1/1">
            <?php if ($image = $plugin->images()->findBy('name', 'logo')) : ?>
              <img src="<?= $image->url() ?>" style="--aspect-ratio: 1/1; object-fit: contain">
            <?php else : ?>
              <span class="bg-light grid place-items-center" style="height: 100%">
                <?= icon($plugin->icon()) ?>
              </span>
            <?php endif ?>
          </div>
        </figure>
        <div class="flex-grow" style="--span: 3">
          <h4 class="h5"><?= $plugin->title() ?></h4>
          <p class="font-mono text-xs color-gray-500 mb-3">
            by <span class="color-black"><?= $plugin->parent()->title() ?></span>
            <?php if ($plugin->paid()->isNotEmpty()) : ?>
            &middot; <span class="plugin-paid">Paid</span>
            <?php endif ?>
          </p>
					<?php snippet('templates/plugins/versions', ['plugin' => $plugin]) ?>
        </div>
      </article>
    </a>
  <?php endforeach ?>
</div>
