<div class="container">
	<?php snippet('layouts/topbar', [
		'icon'   => '👀',
		'title'  => 'Get a glimpse of Kirby 5',
		'button' => 'Learn more',
		'link'   => '/releases/5',
		'active' => $page->is('releases/5')
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
