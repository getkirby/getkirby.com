<figure>
	<a href="<?= $image->url() ?>" data-lightbox>
		<img src="<?= $image->url() ?>">
		<?php if ($image->caption()->isNotEmpty()): ?>
		<figcaption class="text-xs font-mono pt-3">
			<?= $image->caption() ?>
		</figcaption>
		<?php endif ?>
	</a>
</figure>
