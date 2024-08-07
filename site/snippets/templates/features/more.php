<?php
extract([
	'features' => $features ?? array_fill(0, 3, array_fill(0, 5, 'foo'))
])
?>

<style>
.features-more svg {
	width: 32px;
	height: 32px;
	fill: var(--color-black);
}
</style>

<section id="more" class="features-more mb-24">
	<?php snippet('hgroup', [
		'title'    => 'And so much more',
		'subtitle' => $subtitle ?? 'Kirby is packed with features that empower you to build amazing sites.',
		'mb'       => 6
	]) ?>
	<ul class="columns auto-rows-fr" style="--columns-sm: 2; --columns-md: 2; --columns-lg: 5;  --gap: var(--spacing-1)">
		<?php foreach ($features as $feature): ?>
		<?php $feature = option('features')[$feature] ?? [
			'text' => $feature,
			'icon' => 'spaceship',
			'link' => '/'
		] ?>
		<li class="bg-white overflow-hidden rounded">
			<a class="block py-6 color-gray-700" href="<?= $feature['link'] ?>">
				<figure class="flex items-center flex-column justify-center">
					<span class="mb-3"><?= icon($feature['icon']) ?></span>
					<figcaption class="font-mono text-xs truncate"><?= $feature['text'] ?></figcaption>
				</figure>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</section>
