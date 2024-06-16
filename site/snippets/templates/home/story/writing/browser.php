<div class="mb-3 bg-light" style="--aspect-ratio: 5/2">
	<?= img($story->image('dark-forest.jpg'), [
		'src' => [
			'crop'   => true,
			'width'  => 500,
			'height' => 200,
		],
		'srcset' => [
			'500w' => [
				'crop'   => true,
				'width'  => 500,
				'height' => 200,
			],
			'750w' => [
				'crop'   => true,
				'width'  => 750,
				'height' => 300,
			],
		]
	]) ?>
</div>

<div class="max-w-xs mx-auto">
	<div class="text-base">
	Exploring the universe
	</div>
	<div class="text-base color-gray-500 mb-3">
	The edge of nowhere
	</div>

	<div class="text-3xs" style="line-height: 1.5">
	Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful.
	</div>
</div>
