<div class="flex items-center mr-1">
	<?php snippet(
		'templates/reference/entry/decoration',
		['entry' => $entry]
	) ?>

	<span><?= $entry->title() ?></span>
</div>

<?php if ($entry->isUnstable()): ?>
	<span class="reference-entries-unstable">
		<?= icon('lab', 'Unstable') ?>
	</span>
<?php endif ?>

