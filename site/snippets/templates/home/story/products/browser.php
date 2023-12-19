<div class="text-base mb-3">Salt & Pepper</div>

<div class="columns">
	<div style="--span: 8">
		<div class="bg-light" style="--aspect-ratio: 3/2">
			<?= img($story->image('salt-and-pepper.jpg'), [
				'src' => [
					'crop'   => true,
					'width'  => 300,
					'height' => 200,
				],
				'srcset' => [
					'1x' => [
						'crop'   => true,
						'width'  => 300,
						'height' => 200,
					],
					'2x' => [
						'crop'   => true,
						'width'  => 600,
						'height' => 400,
					],
				]
			]) ?>
		</div>
	</div>
	<div style="--span: 4">
		<div class="text-3xs color-gray-400 mb-3">
			<p class="mb-1">Nulla vitae elit libero, a pharetra augue. Sed posuere consectetur est at lobortis.</p>

			<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo.</p>
		</div>
		<div class="text-sm mb-3">
			59 €
		</div>
		<div class="btn btn--filled">
			Buy
		</div>
	</div>
</div>
