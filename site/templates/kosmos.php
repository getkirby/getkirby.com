<?php layout() ?>

<style>
.issues {
	--min: 10rem;
	--gap: var(--container-padding);
}
@media screen and (min-width: 40rem) {
	.issues {
		--min: 20rem;
	}
}
</style>

<article class="kosmos">
	<div class="columns mb-42" style="--columns: 2; --gap: var(--spacing-12)">
		<header class="flex flex-column justify-between">
			<h1 class="h1 mb-12">Kosmos is our monthly newsletter about Kirby and the&nbsp;web</h1>
			<?php snippet('voice', ['voice' => page('voices/ryan-gorley')]) ?>
		</header>
		<?php snippet('templates/kosmos/form') ?>

	</div>

	<section class="w-full p-container bg-dark">
		<header class="flex items-baseline justify-center color-white mb-24">
			<h2 class="h2 mr-1">Past episodes</h2>
			<p><a rel="alternate" type="application/rss+xml" title="Kosmos RSS Feed" class="relative flex p-3 justify-center color-gray-400" style="top: 1px;" href="/kosmos.rss"><?= icon('rss', 'RSS feed') ?></a></p>
		</header>
		<ul class="issues auto-fill">
			<?php foreach ($page->children()->flip() as $issue): ?>
			<li class="shadow-2xl">
				<?php snippet('templates/kosmos/issue', ['issue' => $issue]) ?>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
</article>
