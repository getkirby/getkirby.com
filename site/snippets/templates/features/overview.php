<?php
/**
 * @var array $features
 * @var string|null $intro
 * @var string|null $text
 * @var string $title
 * @var string|null $voice
 */
?>
<?php snippet('templates/features/intro', [
	'title' => $title,
	'intro' => $intro,
	'text'  => $text ?? null,
]) ?>

<div class="mb-<?= $voice ?? null ? 42 : 0 ?>">
	<?php snippet('templates/features/features-grid', ['features' => $features]) ?>
</div>

<?php if ($voice ?? null): ?>
<?php snippet('voice', [
	'voice' => page('voices/' . $voice)
]) ?>
<?php endif ?>
