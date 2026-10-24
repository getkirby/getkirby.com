<?php
/**
 * @var ReferenceIconPage $page
 * @var array $colors
 * @var array $sizes
 */
?>
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
			<figure class="grid place-items-center icon rounded" data-bg="<?= strtolower($color) ?>" data-size="<?= $size ?>">
				<?= icon($page->slug(), local: false) ?>
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
figure.icon[data-size="18"] svg {
	width: 18px;
	height: 18px;
}
figure.icon[data-size="36"] svg {
	width: 36px;
	height: 36px;
}
figure.icon[data-size="72"] svg {
	width: 72px;
	height: 72px;
}
</style>
