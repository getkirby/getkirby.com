<?php
$icon ??= match ($type) {
	'success' => 'smile',
	default   => $type
};
?>

<div class="box-icon iconbox bg-black color-white"><?= icon($icon) ?></div>
<div class="box-text">
	<?= kirbytext($text ?? null) ?>
</div>
