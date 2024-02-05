<?php layout() ?>

<article>
	<header class="max-w-xl mb-24">
		<h1 class="h1 mb-6">Get together</h1>
		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>
	</header>

	<?php if ($message): ?>
	<aside class="block box box--<?= $message['type'] ?> mb-12">
		<?php snippet('kirbytext/box', [
			'type' => $message['type'],
			'text' => $message['text']
		]) ?>
	</aside>
	<?php endif ?>

	<?php snippet('templates/meet/events', ['events' => $events]) ?>
	<?php snippet('templates/meet/map', ['people' => $people]) ?>
	<?php snippet('templates/meet/form') ?>
	<?php snippet('templates/meet/how-to') ?>
	<?php snippet('templates/meet/gallery', ['gallery' => $gallery]) ?>
</article>

