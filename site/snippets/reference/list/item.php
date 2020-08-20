<?php
$excerpt = $excerpt ?? false
?>
<a data-slug="<?= $item->slug() ?>" data-title="<?= $item->title() ?>" href="<?= $item->url() ?>"<?php e($item->isActive(), ' aria-current="page"' ) ?> class="cheatsheet-entry">
  <?php if ($item->intendedTemplate()->name() === 'reference.icon'): ?>
  <figure class="cheatsheet-entry-icon">
    <svg>
      <use xlink:href="#icon-<?= $item->slug() ?>" />
    </svg>
  </figure>
  <?php endif ?>
  <div>
    <?php
    // Add zero-width space characters between the parts of the title.
    // This is necessary, because Google Chrome (tested with v76) does
    // not provide a any good way to wrap the single parts of long
    // titles (e.g. API endpoints) at places, where it makes sense.
    // Inserting "breakpoints" before any slash allows to control
    // the wrapping of long titles.
    $titleSanitized = str_replace('/', '&#8203;/' /* 1 */, $item->title());
    ?>
    <strong><span><?= $titleSanitized ?></span><?php if ($item->method()->isNotEmpty()): ?> <span><?= $item->method() ?></span><?php endif ?></strong>
    <?php if ($excerpt): ?>
    <small><?= $item->excerpt()->kt() ?></small>
    <?php endif ?>
  </div>
</a>
