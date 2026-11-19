<?php
/**
 * @var string|null $html Rendered content (from Marsdown)
 * @var string|null $label
 * @var string|null $text KirbyText content, used without `$html`
 * @var string|null $version
 */
$current = version_compare($version, kirby()->version(), '>=');
?>

<summary <?php e($current, 'class="new"') ?>>
	<?= $current ? 'New in' : 'Since' ?> <?= version($version, $label ?? '%s') ?>
</summary>
<div>
	<?= $html ?? kirbytext($text ?? null) ?>
</div>
