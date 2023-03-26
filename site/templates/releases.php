<?php layout() ?>
<style>

  .versionlist {
    display: inline;
  }

  .versionlist:not(:last-child):after {
    content: ',';
  }
</style>
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
            <?= $release->cover()->toFile()->crop(400) ?>
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
          <div class="">
            <?php $minorReleases = $kirby->option('versions')[$release->version()->value()]['subreleases'];?>
            <div class="h3 mb-6">Further releases</div>
            <ul class="prose">
              <?php foreach ($minorReleases as $subRelease): ?>
                <li class="versionlist">
                  <a href="https://github.com/getkirby/kirby/releases/tag/<?= $subRelease ?>"><?= $subRelease ?></a>
                </li>
              <?php endforeach ?>
            </ul>

          </div>
      </li>
    <?php endforeach ?>
  </ul>

  <footer class="h2 max-w-xl">
    Full list of <a href="https://github.com/getkirby/kirby/releases"><span class="link">all releases</span> &rarr;</a>
  </footer>
</article>