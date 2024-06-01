<?php
extract([
	'open' => $open ?? false
])
?>

<ul class="sidebar-menu-1 <?= $marginBottom ?? '' ?>">
	<?php foreach ($menu as $menuItem): ?>
	<li data-id="<?= $menuItem->id() ?>">
		<?php if ($menuItem->hasListedChildren()): ?>
		<details class="details" <?= $open || $menuItem->isOpen() ? 'open' : '' ?>>
			<summary>
				<a <?= ariaCurrent($menuItem->isActiveInMenu(hasSubmenu: true), 'page') ?> href="<?= $menuItem->menuUrl() ?>"><?= $menuItem->title() ?></a>
			</summary>

			<ul class="sidebar-menu-2">
				<?php foreach ($menuItem->children()->listed() as $submenuItem): ?>
				<li>
					<?php if ($submenuItem->intendedTemplate()->name() === 'separator'): ?>
					<hr>
					<?php else: ?>
					<a <?= ariaCurrent($submenuItem->isOpen(), 'page') ?> href="<?= $submenuItem->menuUrl() ?>"><?= $submenuItem->title() ?></a>
					<?php endif ?>
				</li>
				<?php endforeach ?>
			</ul>
		</details>

		<?php else: ?>
		<a <?= ariaCurrent($menuItem->isActiveInMenu(), 'page') ?> href="<?= $menuItem->menuUrl() ?>"><?= $menuItem->title() ?></a>
		<?php endif ?>
	</li>
	<?php endforeach ?>
</ul>
