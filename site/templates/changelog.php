<?php layout('article') ?>

<?php slot('sidebar') ?>
<nav aria-label="Changelog menu">
  <div class="sidebar sticky" style="--top: var(--spacing-6)">
    <p class="h1 color-gray-400 mb-12"><a href="/docs/changelog">Changelog</a>
    </p>
    <ul class="filters">
      <?php foreach ($releases as $release): ?>
        <li>
          <a
            href="<?= 'changelog#version-' . $release->version()->slug() ?>" <?= ariaCurrent($release->slug() === 'changelog') ?>>
            <?= $release->title() ?>
          </a>
        </li>
      <?php endforeach ?>

    </ul>
  </div>
</nav>
<?php endslot() ?>
<?php slot('header') ?>

<header>
  <h1 class="h1 mb-12"><?= $page->title() ?></h1>
</header>
  <section>
    <?php foreach ($releases as $release): ?>
      <article class="mb-12" style="--span: 12">
        <header class="mb-6">
          <h2 class="h2" id="<?= 'version-' . $release->version()->slug() ?>"
              class="h2">Kirby <?= $release->version() ?></h2>
        </header>
        <div class="mb-12">
          <h3 class="h3 mb-6">Breaking</h3>
          <div class="prose text-sm">
            <?= (new Kirby\Cms\Field(
              $release,
              'breaking',
              str_replace(
                '(docs: releases/breaking-changes vars: version=' . substr($release->version()->value(), 2, 1) . ')',
                '',
                $release->breaking()
              )))->kt() ?>
          </div>
        </div>
        <?php if ($release->deprecated()->isNotEmpty()): ?>
          <div class="mb-12">
            <h3 class="h3 mb-6">Deprecated</h3>
            <div class="prose text-sm">
              <?= $release->deprecated()->kt() ?>
            </div>
          </div>
        <?php endif ?>
      </article>
    <?php endforeach ?>
  </section>
  <footer class="h2 max-w-xl">
    Full list of features of <a href="/releases"><span class="link">all releases</span> &rarr;</a>
  </footer>
<?php endslot() ?>



