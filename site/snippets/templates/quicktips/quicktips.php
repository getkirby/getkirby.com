<ul class="auto-fill" style="--min: 16rem; --column-gap: var(--spacing-12); --row-gap: var(--spacing-12)">
	<?php foreach ($quicktips as $tip): ?>
	<li>
		<p class="text-xs">
			<?= implode(' | ',
				array_map(
					fn ($tag) => Html::a(page('docs/quicktips')->url() . '/tags/' . Str::slug($tag), Str::upper($tag) , ['class' => '']),
					$tip->tags()->split(',')
				)
			);
			?>
		</p>

		<article class="mb-6">
			<a class="block pt-1" href="<?= $tip->url() ?>">
				<figure class="">
					<div class="mb-3">
						<h2 class="h4">
							<?= $tip->title() ?>
						</h2>
					</div>
				</figure>
				<p class="color-gray-700"><?= $tip->description()->widont() ?></p>
			</a>
		</article>
	</li>
	<?php endforeach ?>
</ul>
