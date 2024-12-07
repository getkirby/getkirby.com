<?php layout() ?>

<article>
	<header class="h1 mb-24">
		<h1>Kirby keeps getting<br>better and better<h1>
	</header>

	<ul class="columns mb-24" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
		<?php foreach ($releases = $page->children()->flip() as $release): ?>
			<li>
				<a href="<?= $release->releasePage()->or($release->url()) ?>" class="block mb-1">
					<header class="mb-3">
						<h2 class="h2">
							<?= $release->version() ?>
							<?php if ($release->prerelease()->isNotEmpty()): ?>
								<span class="color-gray-600">Beta</span>
							<?php endif ?>
						</h2>
					</header>

					<?php if ($cover = $release->cover()->toFile()): ?>
						<figure class="border-top mb-6" style="--aspect-ratio: 12/7">
							<?= img($cover, [
								'alt' => 'Cover image for the ' . $release->title() . ' release',
								'src' => [
									'width' => 384
								],
								'lazy' => $releases->indexOf($release) > 2,
								// sizes generated with https://ausi.github.io/respimagelint/
								'sizes' => '(min-width: 1520px) 384px, (min-width: 1160px) calc(27.35vw - 26px), (min-width: 480px) calc(100vw - 96px), 90vw',
								'srcset' => [
									'384w'  => ['width' => 384, 'height' => 224, 'crop' => 'top'],
									'768w'  => ['width' => 768, 'height' => 448, 'crop' => 'top'],
									'1200w' => ['width' => 1200, 'height' => 700, 'crop' => 'top'],
								],
								'class' => 'bg-dark'
							]) ?>
						</figure>
					<?php endif ?>
				</a>

				<div class="color-gray-700 mb-6">
					<p><?= $release->description() ?></p>
				</div>
				<div class="columns mb-6" style="--columns: 2">
					<a href="<?= $release->releasePage()->or($release->url()) ?>" class="btn btn--outlined">
						<?= icon('star') ?>
						New in <?= $release->version() ?>
					</a>
				</div>
				<?php
				$subreleases = $kirby->option('versions')[$release->version()->value()]['subreleases'];
			if (count($subreleases) > 0):
				?>
				<div class="prose">
					<div class="h5 mb-4 color-black">Further releases</div>
					<span class="text-base">
						<?= implode(', ', A::map(
							array_reverse($subreleases),
							fn ($subrelease) => '<a href="https://github.com/getkirby/kirby/releases/tag/' . $subrelease . '">' . $subrelease . '</a>'
						)) ?>
					</span>
				</div>
				<?php endif ?>
			</li>
		<?php endforeach ?>
	</ul>

	<footer class="h2 max-w-xl">
		<div class="mb-6">
			Full list of <a href="https://github.com/getkirby/kirby/releases"><span class="link">all releases</span> &rarr;</a>
		</div>
		<div class="h5">
			All <a href="/changelog"><span class="link">breaking changes</span> since 3.0</a>
		</div>

	</footer>
</article>
