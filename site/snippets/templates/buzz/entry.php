<?php if($entry->video()->isNotEmpty()): ?>
	<div class="buzz-entry">
		<article>
			<figure class="rounded overflow-hidden mb-6 shadow-lg" style="--aspect-ratio: 800/400">
				<?= video($entry->video(), $entry->image('youtube.jpg'), [], [
					'loading' => 'lazy'
				]) ?>
			</figure>

			<a href="<?= $entry->url() ?>">
				<?php snippet('templates/buzz/description', compact('entry')) ?>
			</a>
		</article>
	</div>
<?php elseif ($img = $entry->images()->findBy('name', 'cover') ?? $entry->image()): ?>
	<a href="<?= $entry->url() ?>" class="buzz-entry">
		<article>
			<figure class="rounded overflow-hidden mb-6 shadow-lg" style="--aspect-ratio: 800/400">
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
			</figure>

			<?php snippet('templates/buzz/description', compact('entry')) ?>
		</article>
	</a>
<?php endif ?>
