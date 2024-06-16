<a href="<?= $entry->url() ?>" class="buzz-entry">
	<article>
		<figure class="rounded overflow-hidden mb-6 shadow-lg" style="--aspect-ratio: 800/400">
			<?php if ($entry->video()->isNotEmpty()): ?>
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
			<?php elseif ($img = $entry->image()): ?>
				<?= img($img, [
					'src' => [
						'width' => 384
					],
					'lazy' => $lazy,
					// sizes generated with https://ausi.github.io/respimagelint/
					'sizes' => '(min-width: 1540px) 384px, (min-width: 1260px) calc(23.08vw + 33px), (min-width: 1160px) calc(50vw - 120px), (min-width: 800px) calc(50vw - 72px), (min-width: 480px) calc(100vw - 96px), (min-width: 400px) calc(100vw - 48px), calc(15vw + 275px)',
					'srcset' => [
						384,
						600,
						768,
						1200,
					],
				]) ?>
			<?php endif ?>
		</figure>

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
	</article>
</a>
