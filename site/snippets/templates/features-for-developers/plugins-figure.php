<?php if ($image = image('matomo.jpg')): ?>
<figure>
	<a class="block bg-light rounded mb-3" href="https://plugins.getkirby.com" style="--aspect-ratio: <?= $image->width() . '/' . $image->height() ?>">
		<?= img($image, [
			'alt' => 'A screenshot of the Matomo plugin by Sylvain Julé',
			'src' => [
				'width' => 1000,
			],
			'srcset' => [
				200,
				400,
				800,
				1000,
				1500,
				2000,
			]
		]) ?>
	</a>
	<figcaption class="font-mono text-xs color-gray-700">
		<a href="https://plugins.getkirby.com/sylvainjule/matomo"><strong class="font-normal color-black link">Matomo Plugin</strong> by Sylvain Julé</a>
	</figcaption>
</figure>
<?php endif ?>
