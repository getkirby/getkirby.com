<article
	data-region="<?= $partner->region() ?>"
	data-languages="<?= implode(',', $partner->languages()->split(',')) ?>"
	data-people="<?= $partner->people() ?>"
>
	<button type="button" onclick="infoDialog.showModal()">
		<p class="flex items-center text-xs" style="gap: var(--spacing-1)">
			Certified Kirby Partner
			<?= icon('verified') ?>
		</p>
	</button>
	<?php if (($placeholder ?? false) !== true): ?>
	<a href="<?= $partner->url() ?>">
	<?php endif ?>
		<h3 class="h3 truncate flex mb-3 items-center">
			<?= $partner->title() ?>
		</h3>
		<figure>
			<div style="--aspect-ratio: 2/1" class="mb-3">

                <?php if ($image = $partner->stripe()): ?>
                <img src="<?= $image->url() ?>">
				
				<?php elseif ($image = $partner->avatar()): ?>
                    <img src="<?= $image->url() ?>">
				<?php endif ?>
			</div>
			<figcaption class="font-mono text-sm mb-3">
				<p>
					<?= $partner->subtitle() ?>
				</p>
				<p class="color-gray-700">
					<?= $partner->location() ?>
				</p>
			</figcaption>
		</figure>
		<div class="prose text-sm">
			<?= $partner->summary()->or(($placeholder ?? false) ? 'Short description about yourself in 140 characters or less: your strengths as company and why the audience should choose you.' : '') ?>
		</div>
	<?php if (($placeholder ?? false) !== true): ?>
	</a>
	<?php endif ?>
</article>
