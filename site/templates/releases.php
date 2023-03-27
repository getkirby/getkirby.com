<?php layout() ?>

<article>
  <header class="h1 mb-24">
    <h1>Kirby keeps getting<br>better and better<h1>
  </header>

  <ul class="columns mb-24" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
    <?php foreach ($page->children()->flip()->not(page('releases/4-0')) as $release) : ?>
      <li>
        <header class="mb-3">
          <a href="<?= $release->releasePage()->or($release->url()) ?>" class="h2 mb-1">
            <?= $release->version() ?>
          </a>
        </header>

        <div class=" color-gray-700 mb-12">
          <?php if ($cover = $release->cover()->toFile()): ?>
            <figure class="border-top pt-6 mb-3">
              <img src="<?= $release->cover()->toFile()->crop(400, 250)->url() ?>" class="bg-dark" style="aspect-ratio: 8/5" alt="Open graph image for the <?= $release->title() ?> release">
            </figure>
          <?php endif ?>
        </div>

        <div class=" color-gray-700 mb-6">
          <p><?= $release->description() ?></p>
        </div>
        <div class="columns mb-6" style="--columns: 2">
          <a href="<?= $release->releasePage()->or($release->url()) ?>" class="btn btn--outlined">
            <?= icon('star') ?>
            New in <?= $release->version() ?>
          </a>
        </div>
        <div class="prose">
          <div class="h5 mb-4">Further releases</div>
          <span class="text-base">
            <?= implode(', ', A::map(
              $kirby->option('versions')[$release->version()->value()]['subreleases'],
              fn ($subRelease) => '<a href="https://github.com/getkirby/kirby/releases/tag/' . $subRelease . '">' . $subRelease . '</a>'
            )) ?>
          </span>
        </div>
      </li>
    <?php endforeach ?>
  </ul>

  <footer class="h2 max-w-xl">
    Full list of <a href="https://github.com/getkirby/kirby/releases"><span class="link">all releases</span> &rarr;</a>
  </footer>
</article>
