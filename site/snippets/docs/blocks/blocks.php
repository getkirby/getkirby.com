## Blocks in your templates

If you don't want to care about the HTML for each individual block, you can echo the entire blocks collection to render all blocks.

```php
<?= '<?= $page->myBlocksField()->toBlocks() ?>' ?>

```

## Block snippets

The HTML for each individual block is stored in its own block snippet. All our default block types bring their own snippets and can be overwritten. Block snippets are stored in `/site/snippets/blocks`

As an example, if you want to overwrite the snippet for our heading block, you would create a snippet file called `/site/snippets/blocks/heading.php`

#### The default heading snippet

```php
<?= <<<'CODE'
<<?= $level = $block->level()->or('h2') ?>>
  <?= $block->text() ?>
</<?= $level ?>>
CODE;
?>

```

#### Your customized version

```php "/site/snippets/blocks/heading.php"
<?= <<<'CODE'
<<?= $level = $block->level()->or('h2') ?> id="<?= $block->customId()->or($block->id()) ?>">
  <?= $block->text() ?>
</<?= $level ?>>
CODE;
?>

```

## Looping through blocks

Looping through blocks to control their HTML can be very powerful. You can assign custom CSS classes, IDs for links and more.

You don't need to render the HTML for each individual block in the loop though. You can wrap the block with your custom HTML and then echo the `$block` object to render the matching block snippet.

```php
<?= <<<'CODE'
<?php foreach ($page->myBlocksField()->toBlocks() as $block): ?>
<div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
  <?= $block ?>
</div>
<?php endforeach ?>
CODE;
?>

```

## Manually loading snippets

Sometimes you might wish to customize the way block snippets are loaded. Maybe you want to inject more snippet variables.

```php
<?= <<<'CODE'
<?php foreach ($page->myBlocksField()->toBlocks() as $block): ?>
<div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
  <?php snippet('blocks/' . $block->type(), [
	'block' => $block,
	'theme' => 'dark'
  ]) ?>
</div>
<?php endforeach ?>
CODE;
?>

```

… or load snippets from a different location …

```php
<?= <<<'CODE'
<?php foreach ($page->myBlocksField()->toBlocks() as $block): ?>
<div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
  <?php snippet('blocks/custom/' . $block->type(), [
	'block' => $block,
	'theme' => 'dark'
  ]) ?>
</div>
<?php endforeach ?>
CODE;
?>

```
