<?php layout('cookbook') ?>

<?php slot('hero') ?>
	<header class="mb-12">
		<h1 class="h1 mb-3"><?= $page->title() ?></h1>
		<div class="text-sm">
			<?php foreach ($page->tags()->split(',') as $tag): ?>
				<a href="<?= page('docs/cookbook')->url() . '/tags/' . Str::slug($tag) ?>" class="mr-1 p-1 bg-light rounded">
					<?= $tag ?>
				</a>
			<?php endforeach ?>
	</header>
<?php endslot() ?>


<?php slot() ?>
	<?php snippet('toc', ['title' => 'In this recipe']) ?>
	<div class="prose mb-24">
		<?= $page->text()->kt() ?>
	</div>

	<?php snippet('templates/cookbook/authors', ['authors' => $authors]) ?>
<?php endslot() ?>
