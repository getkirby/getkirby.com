<?php
/**
 * @var ReleasePage $release
 */

$groups = [
	'features'  => 'Features',
	'changes'   => 'All changes',
	'migration' => 'Migration',
];

$menu = $release->children()->listed()->group('category');
?>
<nav class="sidebar" aria-labelledby="sidebar-title">
	<header class="sidebar-header mb-12">
		<p class="h1 color-gray-400">
			<a id="sidebar-title" href="<?= $release->url() ?>"><?= $release->title() ?></a>
		</p>

		<div class="sidebar-mobile-select">
			<label for="mobile-menu">
				Select a page …
				<?= icon('angle-down') ?>
			</label>

			<select id="mobile-menu" onchange="window.location.href = this.value">
				<option disabled selected>Select a page …</option>
				<?php foreach ($groups as $key => $label): ?>
				<optgroup label="<?= $label ?>">
					<?php foreach ($menu->get($key) ?? [] as $item): ?>
					<option value="<?= $item->url() ?>"><?= $item->title() ?></option>
					<?php if ($item->hasListedChildren()): ?>
					<?php foreach ($item->children()->listed() as $subItem): ?>
					<option value="<?= $subItem->url() ?>">&nbsp;&nbsp;&nbsp;<?= $subItem->title() ?></option>
					<?php endforeach ?>
					<?php endif ?>
					<?php endforeach ?>
				</optgroup>
				<?php endforeach ?>
			</select>
		</div>
	</header>

	<?php foreach ($groups as $key => $label): ?>
	<section class="sidebar-group">
		<h2><?= $label ?></h2>
		<ul class="sidebar-menu-1 mb-6">
			<?php foreach ($menu->get($key) ?? [] as $item): ?>
			<li data-id="<?= $item->id() ?>">
				<?php if ($item->hasListedChildren()): ?>
				<details class="details" <?= $item->isOpen() ? 'open' : '' ?>>
					<summary>
						<a <?= ariaCurrent($item->isActive(hasSubmenu: true), 'page') ?> href="<?= $item->menuUrl() ?>"><?= $item->title() ?></a>
					</summary>

					<ul class="sidebar-menu-2">
						<?php foreach ($item->children()->listed() as $subItem): ?>
						<li>
							<a <?= ariaCurrent($subItem->isOpen(), 'page') ?> href="<?= $subItem->menuUrl() ?>"><?= $subItem->title() ?></a>
						</li>
						<?php endforeach ?>
					</ul>
				</details>
				<?php else: ?>
				<a <?= ariaCurrent($item->isActive(), 'page') ?> href="<?= $item->menuUrl() ?>"><?= $item->title() ?></a>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
	<?php endforeach ?>
</nav>
