<?php layout() ?>

<article>

	<header class="mb-12 max-w-xl">
		<h1 class="h1 mb-6">
			<?= $renew ? 'Renew your partnership' : $page->title() ?>
		</h1>

		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>

		<?php if ($message): ?>
		<aside class="pt-6">
			<div class="block box box--<?= $status ?>">
				<?php snippet('kirbytext/box', [
					'type' => $status,
					'text' => $message
				]) ?>
			</div>
		</aside>
		<?php endif ?>
	</header>

	<section class="mb-42">
		<?php snippet('templates/partners-signup/signup', [
			'people' => $people,
			'renew'  => $renew
		]) ?>
	</section>

	<section class="mb-42">
		<h2 class="h2 mb-6">Frequently asked questions</h2>
		<?php snippet('faq') ?>
	</section>

</article>

<?php snippet('templates/partners/info-dialog') ?>
