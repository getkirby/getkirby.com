<?php layout() ?>

<article>
  <header class="h1 mb-24">
    <h1>Kirby keeps getting<br>better and better<h1>
  </header>

  <ul class="columns mb-24" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
    <?php foreach ($page->children()->flip()->not(page('releases/4-0')) as $release) : ?>
      <li>
        <a href="<?= $release->releasePage()->or($release->url()) ?>" class="block mb-1">
          <header class="mb-3">
            <h2 class="h2"><?= $release->version() ?></h2>
          </header>

          <?php if ($cover = $release->cover()->toFile()): ?>
            <figure class="border-top pt-6 mb-6">
              <img src="<?= $release->cover()->toFile()->crop(400, 250)->url() ?>" class="bg-dark" style="aspect-ratio: 8/5" alt="Open graph image for the <?= $release->title() ?> release">
            </figure>
          <?php endif ?>
        </a>

        <div class="color-gray-700 mb-6">
          <p><?= $release->description() ?></p>
        </div>
        <div class="columns mb-6" style="--columns: 2">
          <a href="<?= $release->releasePage()->or($release->url()) ?>" class="btn btn--outlined">
            <?= icon('star') ?>
            New in <?= $release->version() ?>
          </a>
        </div>
        <div class="prose">
          <div class="h5 mb-4 color-black">Further releases</div>
          <span class="text-base">
            <?= implode(', ', A::map(
              array_reverse($kirby->option('versions')[$release->version()->value()]['subreleases']),
              fn ($subRelease) => '<a href="https://github.com/getkirby/kirby/releases/tag/' . $subRelease . '">' . $subRelease . '</a>'
            )) ?>
          </span>
        </div>
      </li>
    <?php endforeach ?>
  </ul>

  <footer class="h2 max-w-xl">
    <div class="mb-6">
      Full list of <a href="https://github.com/getkirby/kirby/releases"><span class="link">all releases</span> &rarr;</a>
    </div>
    <div class="h5">
      All <a href="/changelog"><span class="link">breaking changes</span> since 3.0</a>
    </div>

  </footer>
</article>
