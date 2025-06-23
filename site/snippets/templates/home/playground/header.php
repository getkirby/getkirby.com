<header class="playground-header">
	<div class="playground-header-title mb-12">
		<h1 class="h1">Kirby is the CMS<br>that adapts to you</h1>
		<nav class="auto-fit" style="--min: 9rem; --gap: var(--spacing-3); max-width: 24rem;">
			<a class="btn btn--outlined" href="/releases/5">
				<?= icon('spaceship') ?>
				New in v5
			</a>
			<a class="btn btn--filled" href="/try">
				<?= icon('download') ?>
				Try now
			</a>
		</nav>
	</div>
	<div class="w-full">
		<div class="playground-header-layout">
			<figure class="playground-header-figure" data-theme="light">
				<span
					class="playground-header-figure-wrapper"
					style="--aspect-ratio: <?= $storyImage->width() . '/' . $storyImage->height() ?>"
				>
					<?= img($storyImage, [
						'alt' => $storyImage->alt()->or('Panel screenshot for: ' . $story->title()),
						'src' => $story->storyImageSrcSize(),
						'lazy' => false,
						'fetchpriority' => 'high',
						// sizes generated with https://ausi.github.io/respimagelint/
						'sizes' => '(min-width: 1860px) 1520px, (min-width: 820px) calc(92.16vw - 176px), 100vw',
						'srcset' => $story->storyImageSrcsetSizes()
					]) ?>
				</span>

				<div class="playground-theme-toggle">
					<button data-theme="light" title="Switch to light mode">
						<?= icon('sun') ?>
					<button data-theme="dark" title="Switch to dark mode">
						<?= icon('moon') ?>
					</button>
				</div>

				<div class="playground-header-figure-loader">
					<?= icon('loader') ?>
				</div>
			</figure>
			<div class="playground-header-menu">
				<div class="sticky" style="--top: var(--spacing-2)">
					<ul class="font-mono text-sm pt-6 mb-6">
						<?php foreach ($stories as $option): ?>
						<li>
							<a
								<?php e($story === $option, 'aria-current="true"') ?>
								href="/home.plygrnd?your=<?= $option->slug() ?>"
								data-image-light-src="<?= $option->storyImageLightSrc() ?>"
								data-image-light-srcset="<?= $option->storyImageLightSrcset() ?>"
								data-image-dark-src="<?= $option->storyImageDarkSrc() ?>"
								data-image-dark-srcset="<?= $option->storyImageDarkSrcset() ?>"
							>
								<?= $option->title() ?>
							</a>
						</li>
						<?php endforeach ?>
						<li><a class="font-bold more" href="/love">Your ideas &rarr;</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>
