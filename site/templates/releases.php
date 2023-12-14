<?php layout() ?>

<article>
	<header class="h1 mb-24">
		<h1>Kirby keeps getting<br>better and better<h1>
	</header>

	<ul class="columns mb-24" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 3; --gap: var(--spacing-12)">
		<?php foreach ($page->children()->flip() as $release) : ?>
			<li>
				<a href="<?= $release->releasePage()->or($release->url()) ?>" class="block mb-1">
					<header class="mb-3">
						<h2 class="h2"><?= $release->version() ?></h2>
					</header>

					<?php if ($cover = $release->cover()->toFile()): ?>
						<figure class="border-top pt-6 mb-6">
							<img srcset="<?= $cover->srcset([
								'384w' => ['width' => 384, 'height' => 240, 'crop' => 'center'],
								'768w' => ['width' => 768, 'height' => 480, 'crop' => 'center'],
								'1055w' => ['width' => 1055, 'height' => 659, 'crop' => 'center'],
								'2110w' => ['width' => 2100, 'height' => 1318, 'crop' => 'center']
							]) ?>" sizes="(max-width: 1150px) 90vw, 384px" class="bg-dark" style="aspect-ratio: 8/5" alt="Cover image for the <?= $release->title() ?> release">
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
			if (count($subreleases) > 0) :
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
