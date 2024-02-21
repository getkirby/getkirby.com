<?php layout('cookbook') ?>

<?php slot('h1') ?>
<?= $page->title() ?>
<?php endslot() ?>
<?php slot('sidebar') ?>
<?php snippet('sidebar', [
	'title'         => 'Guide',
	'link'          => '/docs/guide',
	'menu'          => collection('guides'),
	'hasCategories' => true,
]) ?>
<?php endslot() ?>
<?php slot() ?>

<div class="mb-36">
	<ul class="guides auto-fill auto-rows-fr mb-12" style="--min: 16rem; --gap: var(--spacing-12)">
		<?php foreach ($page->resources()->toPages() as $resource): ?>
		<li>
			<article>
				<a class="block" href="<?= $resource->url() ?>">
					<?php if ($parent = $resource->parent()): ?>
					<p class="h6 mb-1 flex align-center justify-between">
						<?= $resource->parent()->title() ?>
					</p>
					<?php endif ?>
					<div class="border-top pt-3">
						<h2 class="h2 mb-3"><?= $resource->title() ?></h2>
						<p class="color-gray-700"><?= $resource->description() ?></p>
					</div>
				</a>
			</article>
		</li>
		<?php endforeach ?>
	</ul>
</div>
<?php endslot() ?>
