<?php foreach ($plugins as $plugin) : ?>
	<article class="mb-6">
		<a href="<?= $plugin->url() ?>" class="bg-dark shadow-xl color-gray-400 rounded overflow-hidden shadow columns" style="--columns: 3; --gap: 0">
			<div class="p-6 flex flex-column justify-between">
				<header>
					<h4 class="color-white font-bold"><?= $plugin->title() ?></h4>
					<p class="block font-mono text-xs color-gray-500 mb-3">
						by <span class="color-white"><?= $plugin->parent()->title() ?></span>
						<?php if ($plugin->paid()->isNotEmpty()) : ?>
						&middot; <span class="plugin-paid">Paid</span>
						<?php endif ?>
					</p>
				</header>
				<div class="prose color-gray-400 text-sm mb-3 flex-grow">
					<?= $plugin->description() ?>
				</div>

				<?php snippet('templates/partners/plugin-versions', ['plugin' => $plugin, 'bg' => 'black']) ?>
			</div>
			<div style="--span: 2">
				<?php if ($image = $plugin->card() ?? $plugin->image()) : ?>
					<img src="<?= $image->url() ?>" class="px-6 pt-6" style="--aspect-ratio: 2/1">
				<?php elseif ($plugin->preview()->isNotEmpty()) : ?>
					<div class="px-6 pt-6">
						<div class="shadow-xl" style="--aspect-ratio: 2/1; background: #000; border-top-left-radius: var(--rounded); border-top-right-radius: var(--rounded); overflow:hidden">
							<div class="flex items-center justify-center">
								<div class="shadow-xl" data-no-copy>
									<?= $plugin->preview()->kt() ?>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
					<span style="--aspect-ratio: 2/1"></span>
				<?php endif ?>
			</div>
		</a>
	</article>
<?php endforeach ?>
