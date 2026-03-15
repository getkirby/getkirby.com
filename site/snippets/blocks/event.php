<?php

/** @var Block $block */

use Kirby\Cms\Block;

?>
<p>
	<strong>
		<a href="<?= $block->link()->value() ?>"><?= $block->title()->value() ?></a>
	</strong><br>
	<?= $block->date()->toDate('D F d, Y \a\t H:i T') ?>
</p>
