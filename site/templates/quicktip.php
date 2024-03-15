<?php layout('cookbook') ?>

<?php slot('h1') ?>
<?= $page->title()->widont() ?>
<?php endslot() ?>

<?php slot('sidebar') ?>
<?php snippet('templates/quicktips/sidebar') ?>
<?php endslot() ?>

<?php slot('tags') ?>
<div class="mb-6">
	<span>Tags:</span>
		<?php foreach ($page->tags()->split(',') as $tag): ?>
			<a href="<?= page('docs/quicktips')->url() . '/tags/' . Str::slug($tag) ?>"><?= $tag ?></a>
		<?php endforeach ?>
</div>
<?php endslot() ?>

<?php slot() ?>
	<?php snippet('toc', ['title' => 'In this recipe']) ?>
	<div class="prose mb-24">
		<?= $page->text()->kt() ?>
	</div>

	<?php snippet('templates/cookbook/authors', ['authors' => $authors]) ?>
<?php endslot() ?>


