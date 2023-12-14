<section id="audience" class="playground-audience mb-56">
	<div class="columns">
		<header class="playground-audience-header max-w-xs h2">
			<h2 id="audience-heading">We build Kirby for your personal success story</h2>
		</header>
		<hr aria-hidden="true" class="hr-v" style="grid-column: 12; grid-row: 1/2">
	</div>

	<nav aria-labelledby="audience-heading" class="playground-audience-links columns">
		<?php foreach (collection('audience') as $audience): ?>
		<a href="<?= $audience->url() ?>">
			<span class="block h6">For</span>
			<span class="h2 link mr-3"><?= $audience->for() ?></span>
			<span aria-hidden="true" class="h2">&rarr;</span>
		</a>
		<?php endforeach ?>
	</nav>
</section>
