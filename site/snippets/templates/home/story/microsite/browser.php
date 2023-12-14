<div class="text-base mb-3">Our app is quite good</div>

<div class="columns text-3xs color-gray-400 mb-3" style="--columns: 3">
	<div>
		It can do all of this here. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
	</div>
	<div>
		It's also capable of lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.
	</div>
	<div>
		Furthermore it's quite good at aenean lacinia bibendum nulla sed consectetur. Vestibulum id ligula porta felis euismod semper.
	</div>
</div>

<div class="columns text-xs color-gray-400" style="--columns: 3">
	<?php foreach ($story->images()->filterBy('name', '^=', 'micro') as $image): ?>
	<div class="bg-light" style="--aspect-ratio: 3/3.5">
		<?= img($image, [
			'src' => [
				'crop'   => true,
				'width'  => 160,
				'height' => 186,
			],
			'srcset' => [
				'1x' => [
					'crop'   => true,
					'width'  => 160,
					'height' => 186,
				],
				'2x' => [
					'crop'   => true,
					'width'  => 320,
					'height' => 372,
				],
			]
		]) ?>
	</div>
	<?php endforeach ?>
</div>
