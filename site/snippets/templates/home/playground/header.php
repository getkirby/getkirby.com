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
			<figure class="playground-header-figure">
				<span
					class="playground-header-figure-wrapper"
					style="--aspect-ratio: <?= $storyImage->width() . '/' . $storyImage->height() ?>"
					data-image="<?= $story->uid() . '/' . $storyImage->mediaHash() ?>"
					data-theme="<?= $theme ?>"
				>
					<?= img($storyImage, [
						'alt' => $storyImage->alt()->or('Panel screenshot for: ' . $story->title()),
						'src' => [
							'width' => 1520
						],
						'lazy' => false,
						'fetchpriority' => 'high',
						// sizes generated with https://ausi.github.io/respimagelint/
						'sizes' => '(min-width: 1860px) 1520px, (min-width: 820px) calc(92.16vw - 176px), 100vw',
						'srcset' => [
							400,
							600,
							800,
							1000,
							1200,
							1520,
							2000,
							2400,
							3040
						]
					]) ?>
				</span>

				<form autocomplete="off" class="playground-theme-toggle">
					<?php if ($theme === 'dark'): ?>
						<button name="theme" value="light" title="Switch to light mode">
							<?= icon('sun') ?>
						</button>
					<?php else: ?>
						<button name="theme" value="dark" title="Switch to dark mode">
							<?= icon('moon') ?>
						</button>
					<?php endif ?>
				</form>
			</figure>
			<div class="playground-header-menu">
				<div class="sticky" style="--top: var(--spacing-2)">
					<ul class="font-mono text-sm pt-6 mb-6">
						<?php foreach ($stories as $option): ?>
						<li>
							<a
								<?php e($story === $option, 'aria-current="true"') ?>
								href="?your=<?= $option->slug() ?>&theme=<?= $theme ?>"
								data-image="<?= $option->uid() . '/' . $option->images()->findBy('name', $storyImageName)->mediaHash() ?>"
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
