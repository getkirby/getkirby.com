<?php snippet('layouts/skipper') ?>

<?php if ($kirby->option('archived') !== true): ?>
	<div class="container">
		<?php snippet('layouts/topbar', [
			'icon'   => '🎉',
			'title'  => 'Kirby 5 is here!',
			'button' => 'Learn more',
			'link'   => '/releases/5',
			'active' => $page->is('releases/5')
		]) ?>
	</div>
<?php endif ?>

<header class="header">
	<div class="container">
		<div class="header-content relative flex items-center">
			<?php snippet('layouts/logo') ?>
			<?php snippet('layouts/menu') ?>
			<?php snippet('layouts/search', ['area' => $search ?? 'all']) ?>
			<?php snippet('layouts/sale') ?>
		</div>
	</div>
</header>