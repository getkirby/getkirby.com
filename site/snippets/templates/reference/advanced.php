<?php $advanced = $kirby->session()->get('getkirby$advanced') === 'yes' ?>
<?php if ($page->hasAdvanced()): ?>
<nav class="reference-advanced flex text-xs">
  <a <?= ariaCurrent(!$advanced) ?> href="<?= $page->url(['query' => 'advanced=no']) ?>">Most used</a>
  <a <?= ariaCurrent($advanced) ?> href="<?= $page->url(['query' => 'advanced=yes']) ?>">All items</a>
</nav>
<?php endif ?>