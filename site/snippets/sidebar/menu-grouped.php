<?php
extract([
	'open' => $open ?? false
])
?>
<?php foreach ($menu->group('category') as $category => $items): ?>
	<h2 class="h6 mb-3"><?= option('categories')[$category] ?? ucfirst($category) ?></h2>
	<ul class="sidebar-menu-1 mb-6">
		<?php foreach ($items as $menuItem): ?>
			<li data-id="<?= $menuItem->id() ?>">
				<?php if ($menuItem->hasListedChildren()): ?>
					<details class="details" <?= $open || $menuItem->isOpen() ? 'open' : '' ?>>
						<summary>
							<a <?= ariaCurrent($menuItem->isActive(), 'page') ?> href="<?= $menuItem->url() ?>"><?= $menuItem->title() ?></a>
						</summary>
						<ul class="sidebar-menu-2">
							<?php foreach ($menuItem->children()->listed() as $submenuItem): ?>
								<li>
									<?php if ($submenuItem->intendedTemplate()->name() === 'separator'): ?>
										<hr>
									<?php else: ?>
										<a <?= ariaCurrent($submenuItem->isOpen(), 'page') ?> href="<?= $submenuItem->url() ?>"><?= $submenuItem->title() ?></a>
									<?php endif ?>
								</li>
							<?php endforeach ?>
						</ul>
					</details>
				<?php else: ?>
					<a <?= ariaCurrent($menuItem->isActive(), 'page') ?> href="<?= $menuItem->url() ?>"><?= $menuItem->title() ?></a>
				<?php endif ?>
			</li>
		<?php endforeach ?>
	</ul>
<?php endforeach ?>
