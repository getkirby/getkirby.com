<?php if($item->pages() > 0): ?>
<nav class="flex items-center justify-between text-sm">
  <?php if ($item->hasPrevPage()): ?>
  <a href="<?= $item->prevPageURL() ?>" rel="prev">
	&larr; Prev
  </a>
  <?php else: ?>
  <span aria-hidden="true" class="color-gray-400">&larr; Prev</span>
  <?php endif ?>
  <span>
	Page <?= $item->page() ?>&nbsp;of&nbsp;<?= $item->pages() ?>
  </span>
  <?php if ($item->hasNextPage()): ?>
  <a href="<?= $item->nextPageURL() ?>" rel="next">
	Next &rarr;
  </a>
  <?php else: ?>
  <span aria-hidden="true" class="color-gray-400">Next &rarr;</span>
  <?php endif ?>
</nav>
<?php endif ?>
