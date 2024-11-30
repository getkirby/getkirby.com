<?php layout('release-guide') ?>

<?php slot('sidebar') ?>
<?php $release = $page->release() ?>
<?php snippet('sidebar', [
	'title' => $release->title(),
	'link'  => $release->url(),
	'menu'  => $release->children()->listed(),
]) ?>
<?php endslot() ?>

<?php slot('content') ?>
<style>
.release-changelog {
	padding: var(--spacing-3);
	font-size: var(--text-md);
}

.release-changelog + .release-changelog {
	margin-top: var(--spacing-3);
}

.release-changelog summary {
	list-style: none;
	font-size: var(--text-lg);
}
.release-changelog summary::marker {
	display: none;
}
.release-changelog[open] summary {
	padding-bottom: var(--spacing-3);
	border-bottom: 1px solid var(--color-border);
	margin-bottom: var(--spacing-3);
}

.release-changelog .prose {
	--prose-size: var(--text-md);
	padding: var(--spacing-3);
}

.release-changelog .prose h2:not(:first-of-type) {
	border-top: 1px solid var(--color-border);
	padding-top: var(--spacing-6);
}
</style>

<section class="mb-12">
	<div class="prose mb-6">
		<?= $page->text()->kt() ?>
	</div>

	<?php snippet('templates/release-5/changelog', [
		'title'   => '✨ Enhancements',
		'changes' => $page->enhancements()
	]) ?>
	<?php snippet('templates/release-5/changelog', [
		'title'   => '🐛 Bugfixes',
		'changes' => $page->bugfixes()
	]) ?>
	<?php snippet('templates/release-5/changelog', [
		'title'   => '⚠️ Breaking changes',
		'changes' => $page->breaking()
	]) ?>
	<?php snippet('templates/release-5/changelog', [
		'title'   => '☠️ Deprecated',
		'changes' => $page->deprecated()
	]) ?>
	<?php snippet('templates/release-5/changelog', [
		'title'   => '♻️ Refactored',
		'changes' => $page->refactored()
	]) ?>
</section>

<?php endslot() ?>
