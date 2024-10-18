<div class="container">
	<?php snippet('layouts/topbar', [
		'icon'   => '🚚',
		'title'  => 'How to migrate to Kirby',
		'button' => 'Tips & tutorials',
		'link'   => '/docs/guide/migration',
		'active' => $page->is('docs/guide/migration')
	]) ?>
</div>

<header class="header">
	<?php snippet('layouts/skipper') ?>
	<div class="container">
		<div class="header-content relative flex items-center">
			<?php snippet('layouts/logo') ?>
			<?php snippet('layouts/menu') ?>
			<?php snippet('layouts/search', ['area' => $search ?? 'all']) ?>
			<?php snippet('layouts/sale') ?>
		</div>
	</div>
</header>
