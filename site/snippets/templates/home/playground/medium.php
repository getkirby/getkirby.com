<section id="medium" class="playground-medium columns">

	<header class="playground-medium-header h2 max-w-xs">
		<h2>More than websites</h2>
		<p class="color-gray-600">Deliver your content to browsers, phones, tablets, smart watches or your refrigerator. Headless or not – you decide.</p>
	</header>

	<span class="hr-v hr-main"></span>

	<figure role="img" aria-label="A browser window with an example website" class="playground-medium-browser bg-white shadow-2xl rounded-xl overflow-hidden">
		<header class="p-3 flex">
			<div class="dots mr-3">
				<i></i>
				<i></i>
				<i></i>
			</div>
			<div class="flex-grow text-center truncate text-xs bg-light mx-auto p-1 rounded">
				<?= $story->browser()->or('yoursite.com') ?>
			</div>
		</header>
		<div class="playground-medium-browser-body p-3 text-xl leading-tight">
			<?php snippet('templates/home/story/' . $story->slug() . '/browser') ?>
		</div>
	</figure>

	<span class="hr-h" style="grid-column: 11/12; grid-row: 1; align-self: center"></span>
	<span class="hr-h" style="grid-column: 12/21"></span>
	<span class="hr-v" style="grid-column: 12; grid-row: span 2"></span>
	<span class="hr-v" style="grid-column: 15; height: var(--spacing-12)"></span>
	<span class="hr-v" style="grid-column: 21; height: var(--spacing-12)"></span>

	<div role="img" aria-label="A phone with an example application" class="playground-medium-phone">
		<div class="relative bg-white overflow-hidden shadow-2xl rounded-xl">
			<header class="color-white leading-snug">
				<p class="font-bold"><?= $story->phoneTitle() ?></p>
				<p class="font-thin"><?= $story->phoneSubtitle() ?></p>
			</header>
			<figure style="--aspect-ratio: 1/2">
				<?= img($story->phoneImage()->toFile(), [
					'src' => [
						'crop'   => true,
						'width'  => 200,
						'height' => 400,
					],
					'srcset' => [
						'200w' => [
							'crop'   => true,
							'width'  => 200,
							'height' => 400,
						],
						'400w' => [
							'crop'   => true,
							'width'  => 400,
							'height' => 800,
						],
					]
				]) ?>
			</figure>
		</div>
	</div>
	<div role="img" aria-label="An example API response" class="playground-medium-api">
		<div class="bg-black shadow-2xl rounded-xl" style="overflow: hidden">
			<?= $story->api()->kt() ?>
		</div>
	</div>

	<span class="hr-h hr-end" style="grid-column: 1/12;"></span>

</section>
