<?php

/** @var Block $block */

use Kirby\Cms\Block;

// Remove emojis and whitespace from start of string
$clean = preg_replace(
	'/^(?:[\p{Extended_Pictographic}\x{2600}-\x{27BF}](?:\x{FE0F}|\x{200D}[\p{Extended_Pictographic}\x{2600}-\x{27BF}])*)+\s*/u',
	'',
	$block->text()->value()
);
?>
<<?= $level = $block->level()->or('h2') ?> id="<?= $block->text()->slug() ?>">
<a href="#<?= $block->text()->slug() ?>">
	<?= ltrim($clean, ' ') ?>
</a>
</<?= $level ?>>