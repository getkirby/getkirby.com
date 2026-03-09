<?php slot('sidebar') ?>
<style>
	.with-sidebar {
		grid-gap: 9rem;
	}
</style>
<nav>
	<div class="mb-12">
		<p class="h1 color-gray-400 mb-1"><a href="/kosmos">Kosmos</a></p>
		<p>&nbsp;</p>
	</div>

	<div class="sticky" style="--top: var(--spacing-12)">
		<?php if ($prev = $page->prevListed()): ?>
			<section class="mb-12">
				<h2 class="h2 mb-6">Previous</h2>
				<?php snippet('templates/kosmos/issue', ['issue' => $prev]) ?>
			</section>
		<?php endif ?>

		<?php if ($next = $page->nextListed()): ?>
			<section class="mb-12">
				<h2 class="h2 mb-6">Next</h2>
				<?php snippet('templates/kosmos/issue', ['issue' => $next]) ?>
			</section>
		<?php endif ?>
	</div>
</nav>
<?php endslot() ?>
