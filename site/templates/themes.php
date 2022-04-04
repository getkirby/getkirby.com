<?php layout() ?>

<style>
  .align-baseline {
    align-items: baseline;
  }
</style>

<h1 class="h1 mb-24 max-w-xl">High-quality themes for your next project …</h1>

</div>

<div class="p-24 bg-light" style="background: var(--color-gray-400)">

  <div class="auto-fit" style="--min: 25rem; --gap: var(--spacing-24)">
    <?php foreach ($page->grandChildren()->shuffle() as $theme) : ?>
      <article>
        <figure class="shadow-xl mb-3" style="--aspect-ratio: 3/2">
          <?= $theme->image() ?>
        </figure>
        <div class="flex align-baseline justify-between">
          <div class="flex align-baseline">
            <h2 class="h3 mb-3 mr-3"><?= $theme->title() ?></h2>
            <p class="font-mono text-xs">
              by <a href=""><?= $theme->parent()->title() ?></a>
            </p>
          </div>
          <p class="font-mono text-xs"><?= $theme->price() ?></p>
        </div>


      </article>
    <?php endforeach ?>
  </div>
</div>

<div class="container">
