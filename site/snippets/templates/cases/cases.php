<ul class="cases columns mb-24" style="--columns-sm: 1; --columns-md: 2; --columns-lg: <?= $columns ?? 3 ?>; --gap: var(--container-padding)">
	<?php foreach ($cases as $case): ?>
	<li>
		<article class="leading-tight color-white">
			<a class="block" 	href="<?= $case->url() ?>">
				<figure class="mb-3 shadow-2xl" style="--aspect-ratio: 3/4">
					<?php if ($image = $case->image()): ?>
						<?= img($image, [
							'alt'    => 'Screenshot of the ' . $image->alt()->or($case->title()) . ' website',
							'src'    => [
								'width' => 450,
							],
							'lazy'   => $cases->indexOf($case) > 2,
							// sizes generated with https://ausi.github.io/respimagelint/
							'sizes'  => '(min-width: 1520px) 352px, (min-width: 1160px) calc(27.35vw - 58px), (min-width: 640px) calc(50vw - 72px), (min-width: 480px) calc(100vw - 96px), 90vw',
							'srcset' => [
								250,
								352,
								500,
								704,
								1000,
							],
						]) ?>
					<?php endif ?>
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
