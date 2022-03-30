<?php if ($title === '-'): ?>
  <hr class="hr" />

<?php elseif ($link ?? null): ?>
  <a <?= ariaCurrent($current, 'page') ?>  href="<?= $link ?>" class="flex items-center" aria-label="<?= $title ?>">
    <span class="mr-3"><?= $icon ?? null ? icon($icon) : '' ?></span>
    <?= $title ?>
  </a>

<?php else: ?>
  <button class="flex items-center search-button" type="button" data-area="<?= $id ?>">
    <span class="mr-3"><?= $icon ?? null ? icon($icon) : '' ?></span>
    <?= $title ?>
  </button>
<?php endif ?>