<?php
extract([
	'throws' => $throws ?? $page->throws()
]);
?>

<?php if (count($throws) > 0): ?>
<h2 id="exceptions"><a href="#exceptions">Exceptions</a></h2>
<div class="table">
	<table>
		<thead>
			<tr>
				<th>Type</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($throws as $throw): ?>
			<tr>
				<td><?= Types::format($throw['type']) ?></td>
				<td class="text"><?= kti($throw['description']) ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php endif ?>
