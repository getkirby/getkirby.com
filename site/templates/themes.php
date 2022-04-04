<?php layout() ?>

<style>
  .align-baseline {
    align-items: baseline;
  }

  .themes {
    background: var(--color-gray-400);
    --min: 25rem;
    --gap: var(--container-padding);
  }

  @media screen and (min-width: 90rem) {
    .themes {
      --min: 30rem;
    }

  }
</style>

<h1 class="h1 mb-24 max-w-xl">High-quality themes for your next project …</h1>

</div>

<div class="p-container themes auto-fit" style="">
  <?php foreach ($page->grandChildren()->shuffle() as $theme) : ?>
    <a href="<?= $theme->link() ?>">
      <article>
        <figure class="shadow-xl mb-3" style="--aspect-ratio: 3/2">
          <?= img($theme->image(), [
            'alt' => 'Screenshot of the ' . $theme->title() . ' theme',
            'src' => [
              'width' => 600
            ],
            'srcset' => [
              '1x' => 600,
              '2x' => 1200,
            ]
          ]) ?>
        </figure>
        <div class="flex align-baseline justify-between">
          <div class="flex align-baseline">
            <h2 class="h3 mb-3 mr-3"><?= $theme->title() ?></h2>
            <p class="font-mono text-xs">
              by <?= $theme->parent()->title() ?>
            </p>
          </div>
          <p class="font-mono text-xs"><?= $theme->price() ?></p>
        </div>
      </article>
    </a>
  <?php endforeach ?>
</div>

<div class="container">
