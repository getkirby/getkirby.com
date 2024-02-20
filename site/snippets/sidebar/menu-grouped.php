<?php
extract([
	'open' => $open ?? false
])
?>
<?php foreach ($menu->group('category') as $category => $items): ?>
	<h2 class="h6 mb-3"><?= option('categories')[$category] ?? ucfirst($category) ?></h2>
	<?php snippet('sidebar/menu', ['menu' => $items, 'marginBottom' => 'mb-6']); ?>
<?php endforeach ?>
