<?php
/**
 * @var array|null $html Rendered content of each column (from Marsdown)
 * @var array|null $text KirbyText content of each column, used without `$html`
 */
$html ??= array_map(fn ($column) => kirbytext($column), $text ?? []);
?>
<?php foreach ($html as $column): ?>
	<div>
		<?= $column ?>
	</div>
<?php endforeach ?>
