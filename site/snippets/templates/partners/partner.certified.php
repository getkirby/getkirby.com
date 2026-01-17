<article
	data-region="<?= $partner->region() ?>"
	data-languages="<?= implode(',', $partner->languages()->split(',')) ?>"
	data-people="<?= $partner->people() ?>"
>
	<button type="button" onclick="infoDialog.showModal()">
		<p class="flex items-center text-xs" style="gap: var(--spacing-1)">
			Certified Kirby Partner
			<?= icon('verified') ?>
		</p>
	</button>
	<?php if (($placeholder ?? false) !== true): ?>
	<a href="<?= $partner->url() ?>">
	<?php endif ?>
		<h3 class="h3 truncate flex mb-3 items-center">
			<?= $partner->title() ?>
		</h3>
		<figure>
			<div style="--aspect-ratio: 2/1" class="mb-3">
				<?php if ($image = $partner->stripe()): ?>
					<?= img($image, [
						'src' => [
							'width'  => 352,
							'height' => 176,
							'crop'   => true,
						],
						'lazy' => $lazy,
						// sizes generated with https://ausi.github.io/respimagelint/
						'sizes' => '(min-width: 1520px) 352px, (min-width: 1160px) calc(27.35vw - 58px), (min-width: 960px) calc(33.33vw - 96px), (min-width: 640px) calc(50vw - 96px), (min-width: 480px) calc(100vw - 96px), 90vw',
						'srcset' => [
							'352w'  => ['width' => 352, 'height' => 176, 'crop' => true],
							'500w'  => ['width' => 500, 'height' => 250, 'crop' => true],
							'704w'  => ['width' => 704, 'height' => 352, 'crop' => true],
							'1000w' => ['width' => 1000, 'height' => 500, 'crop' => true],
						]
					]) ?>
				<?php elseif ($image = $partner->avatar()): ?>
					<span class="p-6 bg-light">
						<?= img($image, [
							'src' => [
								'width'  => 187,
								'height' => 187,
								'crop'   => true,
							],
							'lazy' => $lazy,
							// sizes generated with https://ausi.github.io/respimagelint/
							'sizes' => '(min-width: 1440px) 187px, (min-width: 960px) 13vw, (min-width: 640px) 22vw, 48vw',
							'srcset' => [
								'187w' => ['width' => 187, 'height' => 187, 'crop' => true],
								'374w' => ['width' => 374, 'height' => 374, 'crop' => true],
								'600w' => ['width' => 600, 'height' => 600, 'crop' => true],
							],
							'class' => 'shadow-xl bg-white',
							'style' => 'width: auto; height: 100%;'
						]) ?>
					</span>
				<?php endif ?>
			</div>
			<figcaption class="font-mono text-sm mb-3">
				<p>
					<?= $partner->subtitle() ?>
				</p>
				<p class="color-gray-700">
					<?= $partner->location() ?>
				</p>
			</figcaption>
		</figure>
		<div class="prose text-sm">
			<?= $partner->summary()->or(($placeholder ?? false) ? 'Short description about yourself in 140 characters or less: your strengths as company and why the audience should choose you.' : '') ?>
		</div>
	<?php if (($placeholder ?? false) !== true): ?>
	</a>
	<?php endif ?>
</article>
