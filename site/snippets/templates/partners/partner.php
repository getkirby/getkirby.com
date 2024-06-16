<a
	href="<?= $partner->url() ?>"
	data-region="<?= $partner->region() ?>"
	data-languages="<?= implode(',', $partner->languages()->split(',')) ?>"
	data-type="<?= $partner->typeLabel() ?>"
>
	<article class="columns items-center"
					 style="--columns: 4; --columns-sm: 4; --gap: var(--spacing-6)">
		<figure style="--span: 1; --aspect-ratio: 1/1; overflow: hidden">
			<?php if ($avatar = $partner->avatar()): ?>
				<?= img($avatar, [
					'src' => [
						'width' => 70
					],
					// sizes generated with https://ausi.github.io/respimagelint/
					'sizes' => '(min-width: 1440px) 70px, (min-width: 960px) 5vw, (min-width: 640px) 8vw, 18vw',
					'srcset' => [
						70,
						140,
					]
				]) ?>
			<?php endif ?>
		</figure>
		<header style="--span: 3; --span-sm: 3">
			<p class="text-xs"><?= $partner->typeLabel() ?></p>
			<h3
				class="h3 truncate"><?= $partner->excerptTitle()->or($partner->title()) ?></h3>
			<p class="font-mono text-sm color-gray-600 truncate">
				<?= $partner->location() ?>
			</p>
		</header>
	</article>
</a>
