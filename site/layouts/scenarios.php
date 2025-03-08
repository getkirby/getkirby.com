<!DOCTYPE html>
<html lang="en">
<head>
	<?php snippet('layouts/head') ?>
	<?= css('assets/css/layouts/features.css') ?>
</head>
<body>
	<?php snippet('layouts/header') ?>

	<style>
	@media screen and (max-width: 40rem) {
		.cta {
			grid-template-columns: 1fr;
		}
	}
	</style>

	<main id="main" class="main">
		<div class="container">
			<article>
				<header class="mb-24">
					<div class="columns" style="--columns-md: 1; --columns: 2; --column-gap: var(--spacing-24)">
						<div>
							<h1 class="h1 max-w-xl mb-6"><?= $page->headline() ?></h1>
							<span aria-hidden="true" class="h1 font-thin">&darr;</span>
						</div>
						<div class="pt-3">
							<p class="h6 mb-3"><?= $page->title() ?></p>
							<p class="sr-only">Features:</p>
							<ul class="features-checklist">
								<?php foreach ($page->benefits()->yaml() as $item): ?>
								<li>
									<?= icon('check') ?> <?= $item ?>
								</li>
								<?php endforeach ?>
							</ul>
						</div>
					</div>
				</header>

				<section class="rounded bg-light overflow-hidden mb-42 shadow-xl">
					<?= img('panel.png', [
						'alt' => 'Panel screenshot: ' . $page->title(),
						'lightbox' => 'panel',
						'src' => [
							'width' => 2400
						],
						'lazy' => false,
						// sizes generated with https://ausi.github.io/respimagelint/
						'sizes' => '(min-width: 1540px) 1248px, (min-width: 1160px) calc(77.78vw + 66px), (min-width: 480px) calc(100vw - 96px), 90vw',
						'srcset' => [
							400,
							600,
							800,
							1000,
							1248,
							1520,
							2000,
							2400
						]
					]) ?>
				</section>

				<?= $slot ?>

				<section id="get-started" class="mb-42">
					<h2 class="h2 text-center mb-12">Curious to learn more?</h2>

					<?php snippet('cta', [
						'buttons' => [
							[
								'text' => 'Try now',
								'link' => page('try')->menuUrl(),
								'icon' => 'download'
							],
							[
								'text'  => 'Find a Kirby Partner',
								'link'  => page('partners')->menuUrl(),
								'icon'  => 'verified',
								'style' => 'outlined'
							]
						],
						'maxwidth' => 34
					]) ?>
				</section>
			</article>
		</div>
	</main>

	<?php snippet('layouts/footer') ?>
</body>
</html>
