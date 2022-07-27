## Blocks in your templates

If you don't want to care about the HTML for each individual block, you can echo the entire blocks collection to render all blocks.

```php
<?= '<?= $page->myBlocksField()->toBlocks() ?>' ?>

```

### Looping through blocks

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

### Manually loading snippets

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
