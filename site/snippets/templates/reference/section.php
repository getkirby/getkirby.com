<ul class="reference-section mb-12 auto-fill" style="--min: 15rem; --row-gap: 0; --column-gap: var(--spacing-3)">
	<?php foreach ($item as $entry): ?>
	<li>
		<a href="<?= $entry->url() ?>" class="flex items-center mb-1">
			<?php snippet(
				'templates/reference/entry/decoration',
				['entry' => $entry]
			) ?>
			<?= $entry->title() ?>
		</a>
	</li>
	<?php endforeach ?>
</ul>
