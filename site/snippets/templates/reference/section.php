<?php
$min = match ($page->intendedTemplate()->name()) {
	'reference-endpoints' => '30rem',
	default               => '15rem',
};
?>

<ul
	class="reference-section mb-12 auto-fill"
	style="--min: <?= $min ?>; --row-gap: 0; --column-gap: var(--spacing-3)"
>
	<?php foreach ($item as $entry): ?>
	<li
		data-slug="<?= $entry->slug() ?>"
		data-keywords="<?= $entry->keywords() ?>"
	>
		<a
			href="<?= $entry->url() ?>"
			class="flex items-center justify-between mb-1"
		>
			<?php snippet(
				'templates/reference/section-entry',
				['entry' => $entry]
			) ?>
		</a>
	</li>
	<?php endforeach ?>
</ul>
