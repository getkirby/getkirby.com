<div class="flex items-center mr-3">
	<?php snippet(
	'templates/reference/entry/decoration',
	['entry' => $entry]
) ?>

<?= $entry->title() ?>
</div>

<?php if ($entry->isAdvanced() === true): ?>
<figure class="mr-1 color-gray-600">
	<?= icon('lab') ?>
</figure>
<?php endif ?>
