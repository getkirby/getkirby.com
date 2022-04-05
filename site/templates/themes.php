<?php layout() ?>

<style>
  .align-baseline {
    align-items: baseline;
  }

  .themes {
    background: var(--color-gray-400);
    --min: 15rem;
    --gap: var(--container-padding);
  }

  @media screen and (min-width: 40rem) {
    .themes {
      --min: 25rem;
    }
  }

  @media screen and (min-width: 90rem) {
    .themes {
      --min: 30rem;
    }
  }
</style>

<h1 class="h1 mb-24 max-w-xl">High-quality themes for your next project …</h1>

</div>

<div class="p-container themes auto-fit mb-24">
  <?php foreach ($page->grandChildren()->sortBy('prio', 'asc') as $theme) : ?>
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

  <div class="columns" style="--columns-md: 1; --columns: 2; --gap: var(--spacing-12)">
    <p class="h2">Find more Kirby themes on<br> <a class="link" href="https://getkirby-themes.com">getkirby-themes.com</a> &rarr;</p>
    <p class="h2 max-w-xl">Your theme is missing?<br><a class="link"  href="mailto:support@getkirby.com">Tell us more about it</a> &rarr;</p>
  </div>
