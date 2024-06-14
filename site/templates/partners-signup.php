<?php layout() ?>

<article>

	<header class="mb-12 max-w-xl">
		<h1 class="h1 mb-6"><?= $page->title() ?></h1>

		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>
	</header>

	<section class="mb-42">
		<?php snippet('templates/partners-signup/signup') ?>
	</section>

	<section class="mb-42">
		<h2 class="h2 mb-6">Frequently asked questions</h2>
		<?php snippet('faq') ?>
	</section>

</article>
