<?php
$siblings = $siblings ?? $page->siblings();
if ($siblings->isNotEmpty()): ?>
<nav class="prevnext">
	<?php if ($prev = $page->prevListed($siblings)): ?>
	<a class="prevnext-prev" href="<?= $prev->url() ?>">
		<span class="prevnext-label">Previous page</span>
		<span class="prevnext-title link"><?= $prev->title() ?></span>
	</a>
	<?php endif ?>

	<?php if ($next = $page->nextListed($siblings)): ?>
	<a class="prevnext-next" href="<?= $next->url() ?>">
		<span class="prevnext-label">Next page</span>
		<span class="prevnext-title link"><?= $next->title() ?></span>
	</a>
	<?php endif ?>
</nav>
<?php endif ?>

