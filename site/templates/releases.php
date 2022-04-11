<?php layout() ?>

<article>
  <header class="h1 mb-24">
    <h1>Kirby keeps getting<br>better and better<h1>
  </header>

  <ul class="columns mb-24" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
    <?php foreach ($page->children()->flip() as $release) : ?>
    <li>
      <header class="mb-3">
        <a href="<?= $release->url() ?>" class="h2 mb-1">
          <?= $release->version() ?>
        </a>
      </header>

      <figure class="border-top pt-6 mb-3">
        <?= $release->cover()->toFile()->crop(400) ?>
      </figure>

      <div class=" color-gray-700 mb-12">
        <p><?= $release->description() ?></p>
      </div>
      <div class="columns" style="--columns: 2">
        <a href="<?= $release->url() ?>" class="btn btn--outlined">
          <?= icon('star') ?>
          New in <?= $release->version() ?>
        </a>
      </div>
    </li>
    <?php endforeach ?>
  </ul>

  <footer class="h2 max-w-xl">
    Release notes for <a href="https://github.com/getkirby/kirby/releases"><span class="link">all releases</span> &rarr;</a>
  </footer>
</article>