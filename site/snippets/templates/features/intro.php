<?php snippet('hgroup', [
	'title'    => $title,
	'subtitle' => $intro ?? null,
]) ?>

<?php if ($text ?? null): ?>
<div class="prose text-lg leading-snug mb-12">
	<p><?= $text ?></p>
</div>
<?php endif ?>
