<?php foreach ($items as $item): ?>
	<option value="<?= $item->url() ?>">
		<?= $item->title() ?>
	</option>
	<?php foreach ($item->children()->listed() as $subItem): ?>
	<option value="<?= $subItem->url() ?>">
		&nbsp;&nbsp;&nbsp;<?= $subItem->title() ?>
	</option>
	<?php endforeach ?>
<?php endforeach ?>
