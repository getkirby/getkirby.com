<ul class="auto-fill auto-rows-fr" style="--min: 16rem; --gap: var(--spacing-6)">
	<?php foreach ($recipes as $recipe): ?>
	<li>
		<article class="rounded shadow overflow-hidden" style="background-image: url('<?= $recipe->pattern() ?>'); background-position: top left; background-repeat: no-repeat; height: 100%">
			<a class="block bg-white p-3" href="<?= $recipe->url() ?>" style="height: 100%; margin-left: var(--spacing-5)">
				<figure class="mb-3">
					<div class="mb-3">
						<p class="text-xs font-mono mb-1 flex align-center justify-between">
							<?= $recipe->parent()->title() ?>
							<?php if ($recipe->isNew()): ?>
								<span style="color: var(--color-yellow-500)">
									<?= icon('bolt') ?>
								</span>
							<?php endif ?>
						</p>
						<h2 class="h3 border-top pt-3">
							<?= $recipe->title() ?>
						</h2>
					</div>
				</figure>
				<p class="color-gray-700 text-sm"><?= $recipe->description()->widont() ?></p>
			</a>
		</article>
	</li>
	<?php endforeach ?>
</ul>
