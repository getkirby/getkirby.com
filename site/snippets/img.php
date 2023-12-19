<?php if ($image): ?>
<figure style="--aspect-ratio: <?= $image->width() . '/' . $image->height() ?>">
	<a class="block" data-lightbox="home" href="<?= $image->url() ?>">
		<?= $image ?>
	</a>
</figure>
<?php endif ?>
