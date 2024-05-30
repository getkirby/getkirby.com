<?php if ($resources->count() > 0): ?>
<aside class="mb-24">
	<?php if ($page->text()->isNotEmpty()): ?>
		<h2 class="h2 mb-6" id="resources">
			More information
		</h2>
	<?php endif ?>
	<ul class="columns" style="--columns: 2; --columns-md: 1; gap: var(--spacing-1); grid-auto-rows: auto">
		<?php foreach ($resources as $resource): ?>
		<li class="bg-light rounded p-6">
			<a href="<?= $resource->url() ?>">
				<h3 class="font-bold link"><?= $resource->title() ?></h3>
				<p class="color-gray-800 text-sm"><?= $resource->description() ?></p>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</aside>
<?php endif ?>
