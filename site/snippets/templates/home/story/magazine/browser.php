<div class="text-base">
	Around the world
</div>
<div class="text-base color-gray-500 mb-3">
	In 90 ways
</div>

<div class="columns" style="--columns: 3">
	<?php foreach ($story->images()->template('article') as $image): ?>
	<div>
		<div class="mb-3 bg-light" style="--aspect-ratio: 2/1">
			<?= img($image, [
				'src' => [
					'crop'   => true,
					'width'  => 160,
					'height' => 80,
				],
				'srcset' => [
					'1x' => [
						'crop'   => true,
						'width'  => 160,
						'height' => 80,
					],
					'2x' => [
						'crop'   => true,
						'width'  => 320,
						'height' => 160,
					],
				]
			]) ?>
		</div>
		<div class="text-2xs truncate">
			<?= $image->title() ?>
		</div>
		<div class="text-2xs color-gray-500 mb-3">
			<?= $image->date()->toDate('d M, Y') ?>
		</div>
		<div class="text-3xs color-gray-400">
			Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.
		</div>
	</div>
	<?php endforeach ?>
</div>
