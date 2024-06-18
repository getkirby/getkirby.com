<?php layout() ?>

<header class="mb-12 max-w-xl">
	<div class="text-sm mb-1 color-gray-600">
		<?= $page->category()->widont() ?>
	</div>

	<h1 class="h1 mb-12"><?= $page->title() ?></h1>

	<p class="text-xl leading-snug mb-6">
		<?= $page->intro()->widont() ?>
	</p>

	<?php if ($page->cta()->isNotEmpty()): ?>
		<?php snippet('cta', [
			'buttons' => $page->cta()->yaml(),
			'center'  => false
		]) ?>
	<?php endif ?>
</header>

<?php if ($page->video()->isNotEmpty()): ?>
	<figure class="rounded overflow-hidden mb-12 shadow-lg" style="--aspect-ratio: 800/400">
		<?= video($page->video(), [
			'youtube' => [
				'controls'       => 0,
				'modestbranding' => 1,
				'showinfo'       => 0,
				'rel'            => 0,
			]
		], [
			'loading' => 'lazy'
		]) ?>
	</figure>
<?php endif ?>

<article>
	<div class="prose mb-24">
		<?= $page->text()->kt() ?>
	</div>

	<?php snippet('templates/cookbook/authors', ['authors' => $authors]) ?>
</article>
