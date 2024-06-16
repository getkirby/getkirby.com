<a
	href="<?= $partner->url() ?>"
	data-region="<?= $partner->region() ?>"
	data-languages="<?= implode(',', $partner->languages()->split(',')) ?>"
	data-type="<?= $partner->typeLabel() ?>"
>
	<article>
		<p class="flex items-center text-xs" style="gap: var(--spacing-1)">
			<?= $partner->typeLabel() ?>
			<span class="mr-1"
						title="Certified Kirby Partner"><?= icon('verified') ?></span>
		</p>
		<h3 class="h3 truncate flex mb-3 items-center">
			<?= $partner->title() ?>
		</h3>
		<figure>
			<div style="--aspect-ratio: 3/2" class="mb-3">
				<?php if ($image = $partner->card()): ?>
					<?= img($image, [
						'src' => [
							'width' => 352
						],
						'lazy' => $lazy,
						// sizes generated with https://ausi.github.io/respimagelint/
						'sizes' => '(min-width: 1520px) 352px, (min-width: 1160px) calc(27.35vw - 58px), (min-width: 960px) calc(33.33vw - 96px), (min-width: 640px) calc(50vw - 96px), (min-width: 480px) calc(100vw - 96px), 90vw',
						'srcset' => [
							352,
							500,
							704,
							1000,
						]
					]) ?>
				<?php elseif ($image = $partner->avatar()): ?>
					<span class="p-6 bg-light">
						<?= img($image, [
							'src' => [
								'width' => 187
							],
							'lazy' => $lazy,
							// sizes generated with https://ausi.github.io/respimagelint/
							'sizes' => '(min-width: 1440px) 187px, (min-width: 960px) 13vw, (min-width: 640px) 22vw, 48vw',
							'srcset' => [
								187,
								374,
								600,
							],
							'class' => 'shadow-xl bg-white',
							'style' => 'width: auto; height: 100%;'
						]) ?>
					</span>
				<?php endif ?>
			</div>
			<figcaption class="font-mono text-sm mb-6">
				<p>
					<?= $partner->subtitle() ?>
				</p>
				<p class="color-gray-600">
					<?= $partner->location() ?>
				</p>
			</figcaption>
		</figure>
		<div class="prose text-base">
			<?= $partner->summary() ?>
		</div>
	</article>
</a>
