<header class="mb-12">
	<p class="font-mono text-xs mb-1">
		<?php e($entry->isExternalLink(), '🔗') ?>
		<?= $entry->category() ?>
	</p>
	<h2 class="h3 mb-3"><?= $entry->title()->widont() ?></h2>

	<?php if ($entry->blurb()->isNotEmpty()): ?>
		<p class="text-base color-gray-700"><?= $entry->blurb()->widont() ?></p>
	<?php endif ?>
</header>
