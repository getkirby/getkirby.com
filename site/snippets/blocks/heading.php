<?php

/** @var Block $block */

use Kirby\Cms\Block;

?>
<<?= $level = $block->level()->or('h2') ?> id="<?= $block->text()->slug() ?>">
<a href="#<?= $block->text()->slug() ?>">
	<?= $block->text()->value() ?>
</a>
</<?= $level ?>>
