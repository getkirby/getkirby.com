<?php layout() ?>

<article>

	<header class="mb-12 max-w-xl">
		<h1 class="h1 mb-6">
			<?= $renew ? 'Renew your membership' : $page->title() ?>
		</h1>

		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>

		<?php if ($statusMessage): ?>
		<aside class="pt-6">
			<div class="block box box--<?= $statusType ?>">
				<?php snippet('kirbytext/box', [
					'type' => $statusType,
					'text' => $statusMessage
				]) ?>
			</div>
		</aside>
		<?php endif ?>
	</header>

	<section class="mb-42">
		<?php snippet('templates/partners-signup/signup', [
			...$form,
			'renew' => $renew
		]) ?>
	</section>

	<section class="mb-42">
		<h2 class="h2 mb-6">Frequently asked questions</h2>
		<?php snippet('faq') ?>
	</section>

</article>
