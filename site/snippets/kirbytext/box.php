<?php
/**
 * @var string|null $html Rendered content (from Marsdown)
 * @var string|null $icon
 * @var string|null $text KirbyText content, used without `$html`
 * @var string $type
 */
$icon ??= match ($type) {
	'success' => 'smile',
	default   => $type
};
?>

<div class="box-icon iconbox bg-black color-white"><?= icon($icon) ?></div>
<div class="box-text">
	<?= $html ?? kirbytext($text ?? null) ?>
</div>
