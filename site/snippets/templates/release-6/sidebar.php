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

// returns the menu entries of a group as [page, label] pairs
$entries = function (string $key) use ($menu): array {
	$entries = [];

	foreach ($menu->get($key) ?? [] as $item) {
		if ($key === 'migration') {
			$entries[] = [$item, 'Overview'];

			foreach ($item->children()->listed() as $guide) {
				$entries[] = [$guide, $guide->title()];
			}

			continue;
		}

		$entries[] = [$item, $item->title()];
	}

	return $entries;
};

// the overview of the migration group must not show its guides as submenu
$hasSubmenu = fn ($item, string $key) =>
	$item->hasListedChildren() &&
	($key !== 'migration' || $item->category()->value() !== 'migration');
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
					<?php foreach ($entries($key) as [$item, $text]): ?>
					<option value="<?= $item->url() ?>"><?= $text ?></option>
					<?php if ($hasSubmenu($item, $key)): ?>
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
			<?php foreach ($entries($key) as [$item, $text]): ?>
			<li data-id="<?= $item->id() ?>">
				<?php if ($hasSubmenu($item, $key)): ?>
				<details class="details" <?= $item->isOpen() ? 'open' : '' ?>>
					<summary>
						<a <?= ariaCurrent($item->isActive(hasSubmenu: true), 'page') ?> href="<?= $item->menuUrl() ?>"><?= $text ?></a>
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
				<a <?= ariaCurrent($item->isActive(), 'page') ?> href="<?= $item->menuUrl() ?>"><?= $text ?></a>
				<?php endif ?>
			</li>
			<?php endforeach ?>
		</ul>
	</section>
	<?php endforeach ?>
</nav>
