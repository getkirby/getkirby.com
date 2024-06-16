<div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
	<div>
		<div class="text-base mb-3">
			<div>Creatious labs</div>
			<div class="color-gray-500">Product design</div>
		</div>
		<div class="text-3xs">
			<div class="color-gray-400 mb-3">
				<p class="mb-3">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor. Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>

				<p>Pellentesque non malesuada nisi, vel fermentum odio. Cras ultricies blandit felis, in porta lacus cursus auctor. Donec auctor aliquet lacinia. Aliquam et tortor urna.</p>
			</div>
			<div class="color-gray-500">
				#water #brand
			</div>
		</div>
	</div>
	<div class="playground-medium-browser-gallery">
		<?php foreach ($story->images()->filterBy('name', '^=', 'project') as $image): ?>
		<figure>
			<div class="bg-light" style="--aspect-ratio: 1/1">
				<?php if ($image->name() === 'project-a'): ?>
					<?= img($image, [
						'src' => [
							'crop'   => 'top',
							'width'  => 240,
						],
						'srcset' => [
							'240w' => [
								'crop'   => 'top',
								'width'  => 240,
							],
							'480w' => [
								'crop'   => 'top',
								'width'  => 480
							],
						]
					]) ?>
				<?php else: ?>
					<?= img($image, [
						'src' => [
							'crop'   => true,
							'width'  => 60,
						],
						'srcset' => [
							'60w' => [
								'crop'   => true,
								'width'  => 60,
							],
							'120w' => [
								'crop'   => true,
								'width'  => 120
							],
						]
					]) ?>
				<?php endif ?>
			</div>
		</figure>
		<?php endforeach ?>
	</div>
</div>
