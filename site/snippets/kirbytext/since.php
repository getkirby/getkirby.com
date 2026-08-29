<?php
/**
 * @var string|null $label
 * @var string $text
 * @var string|null $version
 */
$current = version_compare($version, kirby()->version(), '>=');
?>

<summary <?php e($current, 'class="new"') ?>>
	<?= $current ? 'New in' : 'Since' ?> <?= version($version, $label ?? '%s') ?>
</summary>
<div>
	<?= kirbytext($text) ?>
</div>
