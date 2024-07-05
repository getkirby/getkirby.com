<div class="columns" style="--columns: <?= $columns ?? 3 ?>; --gap: var(--spacing-6)">
	<?php foreach ($plugins as $plugin): ?>
		<a class="block bg-white rounded overflow-hidden shadow" href="<?= $plugin->url() ?>">
			<article class="flex flex-column" style="height: 100%">
				<figure class="bg-light">
					<?php if ($card = $plugin->image()): ?>
						<img src="<?= $card->url() ?>" style="--aspect-ratio: 2/1; object-fit: contain;" alt="">
					<?php elseif ($plugin->example()->isNotEmpty()): ?>
						<div style="--aspect-ratio: 2/1; background: #000; overflow:hidden">
							<div class="flex items-center justify-center <?= ($columns ?? 3) === 3 ? ' text-xs' : '' ?>">
								<div class="shadow-xl" data-no-copy>
									<?= $plugin->example()->kt() ?>
								</div>
							</div>
						</div>
					<?php endif ?>
				</figure>
				<div class="flex-grow flex flex-column p-6">
					<header class="mb-3">
						<h3 class="h5"><?= $plugin->title() ?></h3>
					</header>
					<div class="prose flex-grow text-sm mb-6">
						<?= $plugin->description()->excerpt(140) ?>
					</div>
				</div>
			</article>
		</a>
	<?php endforeach ?>
</div>
