<?php layout() ?>

<article class="max-w-xl mx-auto">
	<header>
		<h1 class="h1 mb-12"><?= $page->title() ?></h1>
		<?php if ($page->intro()->isNotEmpty()): ?>
		<div class="prose mb-12">
			<p class="intro">
				<?= $page->intro()->kti() ?>
			</p>
		</div>
		<?php endif ?>
	</header>
	<div class="prose mb-24">
		<?= $page->text()->kt() ?>
	</div>
	<footer>
		<?php snippet('layouts/github-edit') ?>
	</footer>
</article>
