<?php
/**
 * @var bool $hasCategories
 * @var string|null $link
 * @var Kirby\Cms\Pages|Kirby\Toolkit\Collection $menu
 * @var string|null $title
 */
?>
<nav class="sidebar" aria-labelledby="sidebar-title">
	<header class="sidebar-header mb-12">
		<?php if ($title ?? null): ?>
		<p class="h1 color-gray-400">
			<a id="sidebar-title" href="<?= $link ?? '#' ?>"><?= $title ?></a>
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
