<div class="columns" style="--columns: <?= $columns ?? 3 ?>; --gap: var(--spacing-6)">
	<?php foreach ($plugins as $plugin): ?>
		<a class="block bg-white rounded overflow-hidden shadow" href="<?= $plugin->url() ?>">
			<article class="flex flex-column" style="height: 100%">
				<figure class="bg-light">
					<?php if ($card = $plugin->card()): ?>
						<img src="<?= $card->url() ?>" style="--aspect-ratio: 2/1; object-fit: contain;" alt="">
					<?php elseif ($plugin->preview()->isNotEmpty()): ?>
						<div style="--aspect-ratio: 2/1; background: #000; overflow:hidden">
							<div class="flex items-center justify-center <?= ($columns ?? 3) === 3 ? ' text-xs' : '' ?>">
								<div class="shadow-xl" data-no-copy>
									<?= $plugin->preview()->kt() ?>
								</div>
							</div>
						</div>
					<?php elseif ($logo = $plugin->logo()): ?>
						<div style="--aspect-ratio: 2/1; background: var(--color-light)">
							<div class="flex items-center justify-center">
								<div style="height: 66%; --aspect-ratio: 1/1"><img src="<?= $logo->url() ?>" style="object-fit: contain; mix-blend-mode: multiply"></div>
							</div>
						</div>
					<?php else: ?>
						<span class="block" style="--aspect-ratio: 2/1">
							<span>
								<span class="grid place-items-center" style="height: 100%">
									<?= icon($plugin->icon()) ?>
								</span>
							</span>
						</span>
					<?php endif ?>
				</figure>
				<div class="flex-grow flex flex-column p-6">
					<header class="mb-3">
						<h3 class="h5"><?= $plugin->title() ?></h3>
						<p class="font-mono text-xs color-gray-600 truncate">
							by <span class="color-black"><?= $plugin->parent()->title() ?></span>
							<?php if ($plugin->paid()->isNotEmpty()): ?>
							&middot; <span class="plugin-paid">Paid</span>
							<?php endif ?>
						</p>
					</header>
					<div class="prose flex-grow text-sm mb-6">
						<?= $plugin->description()->excerpt(140) ?>
					</div>
					<?php snippet('templates/partners/plugin-versions', ['plugin' => $plugin]) ?>
				</div>
			</article>
		</a>
	<?php endforeach ?>
</div>
