<?php layout('article') ?>

<?php slot('sidebar') ?>
<?php snippet('sidebar', [
	'title'         => 'Guide',
	'link'          => '/docs/guide',
	'menu'          => $menu,
	'hasCategories' => true,
]) ?>
<?php endslot() ?>

<?php slot('resources') ?>
<?php if ($resources->count() > 0): ?>
<aside class="mb-24">
	<?php if ($page->text()->isNotEmpty()): ?>
		<h2 class="h2 mb-6">Additional resources</h2>
	<?php endif ?>
	<ul>
		<?php foreach ($resources as $resource): ?>
		<li class="mb-3 bg-light rounded p-3">
			<a href="<?= $resource->url() ?>">
				<h3 class="h4"><?= $resource->title() ?></h3>
				<p class="color-gray-700"><?= $resource->description() ?></p>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</aside>
<?php endif ?>
<?php endslot() ?>

<?php slot('prevnext') ?>
<?php snippet('layouts/prevnext', ['siblings' => $prevnext]) ?>
<?php endslot() ?>
