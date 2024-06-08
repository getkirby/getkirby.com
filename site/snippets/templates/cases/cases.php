<ul class="cases columns mb-24" style="--columns-sm: 1; --columns-md: 2; --columns-lg: 3; --gap: var(--container-padding)">
	<?php foreach ($cases as $case): ?>
	<li>
		<article class="leading-tight color-white">
			<a class="block" 	href="<?= $case->url() ?>">
				<figure class="mb-3 shadow-2xl" style="--aspect-ratio: 3/4">
					<?= img($image = $case->image(), [
						'alt' => 'Screenshot of the ' . $image->alt() . ' website',
						'src' => [
							'width' => 450
						],
						'lazy' => $cases->indexOf($case) > 2,
						'sizes' => '(min-width: 1320px) 352px, (min-width: 1150px) 27vw, (min-width: 640px) 45vw, 85vw',
						'srcset' => [
							352,
							500,
							550,
							704,
							1000,
							1100
						]
					]) ?>
				</figure>
				<h2 class="font-bold mb-1"><?= $case->title() ?></h2>
				<p class="font-mono text-xs color-gray-400">
					<?= $case->link()->shortUrl() ?>
				</p>
			</a>
		</article>
	</li>
	<?php endforeach ?>
</ul>
