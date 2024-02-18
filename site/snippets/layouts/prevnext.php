<nav class="mb-24">
	<?php $columnCount = $page->prevListed(page('docs/guide')->index()->listed()) === null ? 1 : 2; ?>
	<div class="columns" style="--columns-md: 1; --columns: <?= $columnCount ?>;">
		<?php if ($prev = $page->prevListed(page('docs/guide')->index()->listed())): ?>
			<div class="prose">
				<span class="block text-xs">← Previous</span>
				<a class="" href="<?= $prev->url() ?>">
					<span class="block"><?= $prev->title() ?></span>
				</a>
			</div>
		<?php endif ?>

		<?php if ($next = $page->nextListed(page('docs/guide')->index()->listed())): ?>
			<div class="prose text-right">
				<span class="block text-xs">Next →</span>
				<a href="<?= $next->url() ?>">
					<span class="block"><?= $next->title() ?></span>
				</a>
			</div>
		<?php endif ?>
	</div>
</nav>

