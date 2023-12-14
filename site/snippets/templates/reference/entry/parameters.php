<?php
extract([
	'title' => $title ?? 'Parameters',
	'intro' => $intro ?? null,
	'rows'  => $rows ?? $page->parameters()
]);

extract([
	'hasDefaults'     => $defaults ?? true,
	'hasDescriptions' => count(array_filter(array_column($rows, 'description'))) > 0
]);
?>

<?php if (count($rows) > 0): ?>

<?php if ($title): ?>
<h2 id="<?= Str::slug($title) ?>">
	<a href="#<?= Str::slug($title) ?>"><?= $title ?></a>
</h2>
<?php endif ?>

<?php if ($intro): ?>
<?= kirbytext($intro) ?>
<?php endif ?>

<div class="table">
	<table class="parameters">
		<thead>
			<tr>
				<th>Name</th>
				<th>Type</th>

				<?php if ($hasDefaults) : ?>
				<th>Default</th>
				<?php endif ?>

				<?php if ($hasDescriptions) : ?>
				<th>Description</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rows as $row): ?>
			<tr>
				<td>
					<?= ($row['variadic'] ?? false) ? '...' : null ?>
					<?= $row['name'] ?>
					<?= Types::required($row['required']) ?>
				</td>
				<td><?= Types::format($row['type']) ?></td>

				<?php if ($hasDefaults) : ?>
				<td data-label="Default:"><?= Types::default($row['default']) ?></td>
				<?php endif ?>

				<?php if ($hasDescriptions) : ?>
				<td><?= kti($row['description']) ?></td>
				<?php endif ?>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php endif ?>
