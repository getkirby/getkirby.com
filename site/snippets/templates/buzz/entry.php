<a href="<?= $entry->url() ?>" class="buzz-entry">
	<article>
		<figure class="rounded overflow-hidden mb-6 shadow-lg" style="--aspect-ratio: 800/400">
			<?php if ($entry->video()->isNotEmpty()) : ?>
				<?= video($entry->video(), [
					'youtube' => [
						'controls'       => 0,
						'modestbranding' => 1,
						'showinfo'       => 0,
						'rel'            => 0,
					]
				], [
					'loading' => 'lazy'
				]) ?>
			<?php elseif ($img = $entry->image()) : ?>
				<?= $img->resize(800, 400) ?>
			<?php endif ?>
		</figure>

		<header class="mb-12">
			<p class="font-mono text-xs mb-1">
				<?php e($entry->isExternalLink(), '🔗') ?>
				<?= $entry->category() ?>
			</p>
			<h2 class="h3 mb-3"><?= $entry->title()->widont() ?></h2>

			<?php if ($entry->blurb()->isNotEmpty()) : ?>
				<p class="text-base color-gray-700"><?= $entry->blurb()->widont() ?></p>
			<?php endif ?>
		</header>
	</article>
</a>
