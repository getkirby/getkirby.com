<?php
$icon ??= match ($type) {
	'success' => 'smile',
	default   => $type
};
?>

<figure class="box-icon iconbox bg-black color-white"><?= icon($icon) ?></figure>
<div class="box-text">
	<?= kirbytext($text ?? null) ?>
</div>
