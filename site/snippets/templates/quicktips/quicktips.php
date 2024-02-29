<ul class="auto-fill" style="--min: 16rem; --column-gap: var(--spacing-12); --row-gap: var(--spacing-12)">
	<?php foreach ($quicktips as $tip): ?>
	<li>
		<p class="font-mono text-xs mb-1"><?= implode(',', array_map(fn($item) => Str::upper($item), $tip->tags()->split(',') ?? [])) ?></p>
		<article class="mb-6">
			<a class="block pt-1" href="<?= $tip->url() ?>">
				<figure class="">
					<div class="mb-3">
						<h2 class="h3">
							<?= $tip->description() ?>
						</h2>
					</div>
				</figure>
				<!--p class="color-gray-700"><?= $tip->description()->widont() ?></p-->
			</a>
		</article>
	</li>
	<?php endforeach ?>
</ul>
