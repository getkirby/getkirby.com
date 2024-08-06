<li class="brand <?= $brand->slug() ?> <?= $class ?? null ?>" title="<?= $brand->title() ?>">
	<?= $brand->image()->read() ?>

	<style>
		.brand.<?= $brand->slug() ?> svg {
			max-height: <?= $brand->height()->or('auto') ?>;
			margin-top: <?= $brand->top()->or('0') ?>;
		}
	</style>
</li>
