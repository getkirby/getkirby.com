<nav class="sidebar">
	<?php if ($title ?? null): ?>
	<p class="h1 mb-12 color-gray-400">
		<a href="<?= $link ?? '#' ?>"><?= $title ?></a>
	</p>
	<?php endif ?>
	<?php snippet('sidebar/menu', ['menu' => $menu]) ?>
</nav>
