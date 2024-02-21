<?php foreach ($menu->group('category') as $category => $items): ?>
<section class="sidebar-group">
	<h2><?= option('categories')[$category] ?? ucfirst($category) ?></h2>
	<?php snippet('sidebar/menu', ['menu' => $items, 'marginBottom' => 'mb-6']); ?>
</section>
<?php endforeach ?>
