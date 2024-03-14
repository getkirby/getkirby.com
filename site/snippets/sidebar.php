<nav class="sidebar">
	<header class="sidebar-header mb-12">
		<?php if ($title ?? null): ?>
		<p class="h1 color-gray-400">
			<a href="<?= $link ?? '#' ?>"><?= $title ?></a>
		</p>
		<?php endif ?>

		<?php snippet('sidebar/mobile-select', [
			'hasCategories' => $hasCategories ?? false,
			'menu'          => $menu
		]) ?>
	</header>

	<?php if ($hasCategories ?? false): ?>
		<?php snippet('sidebar/menu-grouped', ['menu' => $menu]) ?>
	<?php else: ?>
		<?php snippet('sidebar/menu', ['menu' => $menu]) ?>
	<?php endif ?>
</nav>
