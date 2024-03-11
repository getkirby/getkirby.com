<div class="container">
	<?php snippet('layouts/topbar', [
		'icon'   => '🚀',
		'title'  => 'A new era: Kirby 4',
		'button' => 'Get to know',
		'link'   => '/releases/4.0',
		'active' => $page->is('releases/4-0')
	]) ?>
</div>

<header class="header mb-24">
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
