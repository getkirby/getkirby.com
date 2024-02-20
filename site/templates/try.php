<?php layout() ?>

<article>
	<header class="mb-24">
		<div class="max-w-xl">
			<h1 class="h1 mb-6">
				Try Kirby
			</h1>

			<p class="text-xl leading-snug color-gray-700">
				Explore our online demo, or download Kirby and try it out yourself. Ready to launch? <a class="color-black link" href="/buy">Buy a license.</a>
			</p>
		</div>

		<?php if ($statusMessage): ?>
		<aside class="pt-6">
			<a href="/try" class="block box box--<?= $statusType ?>">
				<?php snippet('kirbytext/box', [
					'type' => $statusType,
					'text' => $statusMessage
				]) ?>
			</a>
		</aside>
		<?php endif ?>
	</header>

	<div class="columns mb-36" style="--columns: 1; --columns-lg: 2; --gap: var(--spacing-24)">

		<form id="demo" class="demo mb-6" action="https://<?= r(param('demo') === 'staging', 'staging.') ?>trykirby.com" method="post">
			<h2 class="h2 mb-6">
				Instant online demo
			</h2>

			<p class="text-lg color-gray-700 leading-snug mb-6">
				You are one click away from your personal demo. Explore the Panel and get to know Kirby with our six example projects.
			</p>

			<button aria-label="Start the demo" class="block rounded shadow-2xl w-100% mb-6">
				<?php if ($image = image('home/company/panel.png')): ?>
				<figure class="bg-light" style="--aspect-ratio: <?= $image->width() ?>/<?= $image->height() ?>">
					<?= img($image, [
						'alt' => 'A screenshot of the Panel',
						'src' => [
							'width'  => 1000,
						],
						'srcset' => [
							'1x' => [
								'width'  => 1000
							],
							'2x' => [
								'width'  => 1500
							],
						]
					]) ?>
				</figure>
				<?php endif ?>
			</button>

			<button class="btn btn--filled">
				<?= icon('bolt') ?>
				Start Demo
			</button>
		</form>

		<section id="kits">
			<h2 class="h2 mb-6">On your computer</h2>

			<p class="text-lg color-gray-700 leading-snug mb-6">
				Install Kirby on your computer or a test server and
				evaluate it as long as you need. How? <a class="color-black link" href="/docs/guide/quickstart">Get up and running …</a>
			</p>

			<div class="columns shadow-2xl bg-light overflow-hidden rounded" style="--columns: 1; --columns-lg: 2; --gap: var(--spacing-2px)">
				<article class="p-6 bg-white">
					<h2 class="font-bold mb-1">Starterkit</h2>
					<p class="mb-6">Fully annotated sample site for everyone who wants to learn about Kirby's capabilities. </p>
					<a aria-label="Download the Starterkit" class="btn btn--filled" href="https://github.com/getkirby/starterkit/archive/main.zip">
						<?= icon('download') ?>
						Download
					</a>
				</article>

				<article class="p-6 bg-white">
					<h2 class="font-bold mb-1">Plainkit</h2>
					<p class="mb-6">No templates, no content, no styles – just you, Kirby and your imagination.</p>
					<a aria-label="Download the Plainkit" class="btn btn--filled" href="https://github.com/getkirby/plainkit/archive/main.zip">
						<?= icon('download') ?>
						Download
					</a>
				</article>
			</div>
		</section>
	</div>

	<section class="mb-42">
		<h2 class="h2 mb-6">Frequently asked questions</h2>
		<?php snippet('faq') ?>
	</section>

	<?php snippet('templates/home/brands') ?>
</article>

<dialog id="loader" class="overlay">
	<div class="bg-white rounded text-center shadow-xl p-12">
		<p class="font-bold">We are preparing your demo 🎉</p>
		<p>This can take a few seconds. Please don't close this window!<br>You will be redirected automatically ...</p>
	</div>
</dialog>

<script>
document.querySelector(".demo").addEventListener("submit", (e) => {
	document.querySelector("#loader").show();
	document.body.style.cursor = "progress";
});
</script>
