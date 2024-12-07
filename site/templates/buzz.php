<?php layout() ?>

<article class="buzz">
	<header class="mb-24">
		<h1 class="h1">What we say.<br>What others say.<br>The buzz.</h1>
	</header>

	<div class="auto-fill mb-36" style="--min: 20rem; --gap: var(--spacing-12)">
		<?php foreach ($entries = $page->children()->listed()->flip() as $entry): ?>
			<?php snippet('templates/buzz/entry', [
				'entry' => $entry,
				'lazy'  => $entries->indexOf($entry) > 2
			]) ?>
		<?php endforeach ?>
	</div>

	<?php snippet('templates/home/updates', [
		'title' => 'More ways to stay up-to-date:'
	]) ?>
</article>
