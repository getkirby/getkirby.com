<?php layout('reference') ?>

<div class="prose">
	<?= $page->example()->kt() ?>

	<?php if ($parameters->count() > 0): ?>
	<h2 id="parameters"><a href="#parameters">Parameters</a></h2>
	<div class="table">
		<table>
			<thead>
				<th>Parameter</th>
				<th>Type</th>
			</thead>
			<?php foreach ($parameters as $parameter): ?>
			<tr>
				<td><?= $parameter->name() ?></td>
				<td><?= $parameter->types()->toHtml(fallback: 'mixed') ?></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>
	<?php endif ?>

	<?= $page->details()->kt() ?>
</div>
