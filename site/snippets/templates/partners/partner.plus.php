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
						'sizes' => '(min-width: 1440px) 352px, (min-width: 960px) 37vw, (min-width: 640px) 40vw, 85vw',
						'srcset' => [
							352,
							500,
							550,
							704,
							1000,
							1100
						]
					]) ?>
				<?php elseif ($image = $partner->avatar()): ?>
					<span class="p-6 bg-light">
						<?= img($image, [
							'src' => [
								'width' => 187
							],
							'lazy' => $lazy,
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
