<?php if (($placeholder ?? false) !== true): ?>
<a
	href="<?= $partner->url() ?>"
	data-region="<?= $partner->region() ?>"
	data-languages="<?= implode(',', $partner->languages()->split(',')) ?>"
	data-people="<?= $partner->people() ?>"
>
<?php endif ?>
	<article class="columns items-center"
					 style="--columns: 4; --columns-sm: 4; --gap: var(--spacing-6)">
		<figure style="--span: 1; --aspect-ratio: 1/1; overflow: hidden">
			<?php if ($avatar = $partner->avatar()): ?>
				<?= img($avatar, [
					'src' => [
						'width'  => 70,
						'height' => 70,
						'crop'   => true,
					],
					// sizes generated with https://ausi.github.io/respimagelint/
					'sizes' => '(min-width: 1440px) 70px, (min-width: 960px) 5vw, (min-width: 640px) 8vw, 18vw',
					'srcset' => [
						['width' => 70, 'height' => 70, 'crop' => true],
						['width' => 140, 'height' => 140, 'crop' => true],
					]
				]) ?>
			<?php endif ?>
		</figure>
		<header style="--span: 3; --span-sm: 3">
			<p class="text-xs"><?= $partner->subtitle() ?></p>
			<h3
				class="h3 truncate"><?= $partner->excerptTitle()->or($partner->title()) ?></h3>
			<p class="font-mono text-sm color-gray-700 truncate">
				<?= $partner->location() ?>
			</p>
		</header>
	</article>
<?php if (($placeholder ?? false) !== true): ?>
</a>
<?php endif ?>
