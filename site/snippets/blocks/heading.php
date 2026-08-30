<?php
/**
 * @var Kirby\Cms\Block $block
 */
?>
<<?= $level = $block->level()->or('h2') ?> id="<?= $block->text()->slug() ?>">
<a href="#<?= $block->text()->slug() ?>">
	<?= $block->text()->value() ?>
</a>
</<?= $level ?>>
