<a class="logo" href="<?= $link ?? '/' ?>">
  <?= icon('icon') ?>
</a>

<?php if ($page->parents()->has(page('docs')) === true): ?>
<p class="version <?php e(option('archived') === true, 'archived') ?>">
  <a class="font-bold" href="https://github.com/getkirby/kirby/releases/<?= $kirby->version() ?>">
    Kirby <span class="link tabular-nums"><?= $kirby->version() ?></span>
  </a>
</p>
<?php endif ?>
