<?php

/** @var Block $block */

use Kirby\Cms\Block;

$alt  = $block->alt();
$url  = $block->url()->esc();
$link = $block->link();

if ($url): ?>
	<figure class="image">
		<?php if ($link->isNotEmpty()): ?>
			<a href="<?= Str::esc($link->toUrl()) ?>">
				<img src="<?= $url ?>" alt="<?= $alt->esc() ?>">
			</a>
		<?php else: ?>
			<img src="<?= $url ?>" alt="<?= $alt->esc() ?>">
		<?php endif ?>
	</figure>
<?php endif ?>
