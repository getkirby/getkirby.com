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
