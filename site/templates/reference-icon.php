<?php layout('reference') ?>

<div class="prose mb-12">
	<?= $page->text()->kt() ?>
</div>

<?php foreach ($colors as $color): ?>
<section class="mb-12">
	<h2 class="h3 mb-1" id="<?= $slug = Str::slug($color) ?>">
		<a href="#<?= $slug ?>">
			<?= $color ?>
		</a>
	</h2>
	<ul class="columns" style="--columns: 3">
		<?php foreach ($sizes as $size): ?>
		<li>
			<h3 class="font-mono mb-1"><?= $size ?> px</h3>
			<figure class="grid place-items-center icon rounded" data-bg="<?= strtolower($color) ?>">
				<svg data-size="<?= $size ?>">
					<use xlink:href="#icon-<?= $page->slug() ?>" />
				</svg>
			</figure>
		</li>
		<?php endforeach ?>
	</ul>
</section>
<?php endforeach ?>

<style>
figure.icon {
	height: 12rem;
	background: var(--color-light);
}
figure.icon[data-bg="white"] {
	background: var(--color-black);
}
figure.icon[data-bg="white"] svg {
	fill: var(--color-white);
}
svg[data-size="18"] {
	width: 18px;
	height: 18px;
}
svg[data-size="36"] {
	width: 36px;
	height: 36px;
}
svg[data-size="72"] {
	width: 72px;
	height: 72px;
}
</style>
