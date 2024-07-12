<?php layout() ?>

<article>

	<header class="mb-12 max-w-xl">
		<h1 class="h1 mb-6">
			Find a Kirby partner:<br>
			Post your project
		</h1>

		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>
	</header>

	<?php if ($message): ?>
	<aside class="mb-6">
		<div class="block box box--alert">
			<?php snippet('kirbytext/box', [
				'type' => 'alert',
				'text' => $message
			]) ?>
		</div>
	</aside>
	<?php endif ?>

	<section class="mb-42">
		<?php snippet('templates/partners-lead/form') ?>
	</section>


	<section class="mb-42">
		<h2 class="h2 mb-6">Frequently asked questions</h2>
		<?php snippet('faq') ?>
	</section>
</article>
