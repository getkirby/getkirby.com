<nav class="auto-fit items-center mb-<?= $mb ?? 0 ?> <?= ($center ?? true) ? ' mx-auto' : '' ?>" style="--min: 9rem; --gap: var(--spacing-3); max-width: <?= $maxwidth ?? 24 ?>rem">
	<?php foreach ($buttons as $btn): ?>
	<a class="btn btn--<?= $btn['style'] ?? 'filled' ?>" href="<?= $btn['link'] ?>">
		<?php if ($btn['icon'] ?? null): ?>
		<?= icon($btn['icon']) ?>
		<?php endif ?>
		<?= $btn['text'] ?>
	</a>
	<?php endforeach ?>
</nav>
