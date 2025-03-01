<?php

use Kirby\Toolkit\Str;

$title         ??= 'Parameters';
$intro         ??= null;
$parameters    ??= $page->reflection()?->parameters();
$hasDescriptions = $parameters?->hasDescriptions() ?? false;
$parameters      = $parameters?->toArray() ?? [];
?>

<?php if (count($parameters) > 0): ?>
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
				<th>Default</th>

				<?php if ($hasDescriptions): ?>
				<th>Description</th>
				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($parameters as $parameter): ?>
			<tr>
				<td>
					<?= $parameter->isVariadic() ? '...' : null ?>
					<?= $parameter->name() ?>
					<?= required($parameter->isRequired()) ?>
				</td>
				<td><?= $parameter->types()->toHtml(fallback: 'mixed') ?></td>

				<td data-label="Default:">
					<?php if ($default = $parameter->default()): ?>
					<code><?= $default ?></code>
					<?php else: ?>
					<span>–</span>
					<?php endif ?>
				</td>

				<?php if ($hasDescriptions): ?>
				<td><?= kti($parameter->description()) ?></td>
				<?php endif ?>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php endif ?>
