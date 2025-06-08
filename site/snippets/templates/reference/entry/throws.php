<?php
$reflection = $page->reflection();
?>

<?php if ($throws = $reflection->throws()): ?>
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
			<?php foreach ($throws as $exception): ?>
			<tr>
				<td><?= $exception->types()->toHtml() ?></td>
				<td class="text"><?= kti($exception->description()) ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php endif ?>
