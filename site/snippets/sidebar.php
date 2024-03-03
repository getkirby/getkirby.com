<nav class="sidebar">
	<select
		class="sidebar-mobile-navigate"
		onchange="window.location.href = this.value"
	>
		<option disabled selected>Select a page</option>
		<?php if ($hasCategories ?? false): ?>
			<?php foreach ($menu->group('category') as $category => $items): ?>
				<optgroup label="<?= option('categories')[$category] ?? ucfirst($category) ?>">
					<?php foreach ($items as $item): ?>
						<option value="<?= $item->url() ?>">
							<?= $item->title() ?>
						</option>
						<?php foreach ($item->children()->listed() as $subItem): ?>
						<option value="<?= $subItem->url() ?>">
							&nbsp;&nbsp;&nbsp;<?= $subItem->title() ?>
						</option>
						<?php endforeach ?>
					<?php endforeach ?>
				</optgroup>
			<?php endforeach ?>
		<?php else: ?>
			<?php foreach ($menu as $item): ?>
				<option value="<?= $item->url() ?>">
					<?= $item->title() ?>
				</option>
				<?php foreach ($item->children()->listed() as $subItem): ?>
				<option value="<?= $subItem->url() ?>">
					&nbsp;&nbsp;&nbsp;<?= $subItem->title() ?>
				</option>
				<?php endforeach ?>
			<?php endforeach ?>
		<?php endif ?>
	</select>

	<?php if ($title ?? null): ?>
	<p class="h1 color-gray-400 mb-12">
		<a href="<?= $link ?? '#' ?>"><?= $title ?></a>
	</p>
	<?php endif ?>

	<?php if ($hasCategories ?? false): ?>
		<?php snippet('sidebar/menu-grouped', ['menu' => $menu]) ?>
	<?php else: ?>
		<?php snippet('sidebar/menu', ['menu' => $menu]) ?>
	<?php endif ?>
</nav>
