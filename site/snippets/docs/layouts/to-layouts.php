## How to render layouts in templates?

Using the (method: $field::toLayouts text: toLayouts) field method, you can retrieve a Layouts collection - a collection of `Kirby\Cms\Layout` objects:

```php
<?= <<<'CODE'
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<section class="grid" id="<?= $layout->id() ?>">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="column" style="--span:<?= $column->span() ?>">
	<div class="blocks">
	  <?= $column->blocks() ?>
	</div>
  </div>
  <?php endforeach ?>
</section>
<?php endforeach ?>
CODE;
?>

```

## Calculate the column span value

Each column in a layout has a (method: Kirby\Cms\LayoutColumn::width text: $column->width()) method which will return the width defined in the blueprint. (i.e. `1/2`) but for many grid systems you need to know how many columns the current column should span in the grid. This can be done with the (method: Kirby\Cms\LayoutColumn::span text: $column->span()) method. The method calculates with a 12-column grid by default. So for example, if your column width is `1/2` the span method would return a value of 6. If you are working with a different kind of grid system you can pass the number of columns like this: `$column->span(6)`:

```php
<?= <<<'CODE'
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<section class="6-column-grid" id="<?= $layout->id() ?>">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="column" style="--span:<?= $column->span(6) ?>">
	<div class="blocks">
	  <?= $column->blocks() ?>
	</div>
  </div>
  <?php endforeach ?>
</section>
<?php endforeach ?>
CODE;
?>

```

## Working with individual blocks

In some cases, you might even want to controll the way blocks within layouts are rendered. (method: Kirby\Cms\LayoutColumn::blocks text: $column->blocks()) will return a blocks collection that you can work with and create another nested foreach loop.

```php
<?= <<<'CODE'
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<section class="6-column-grid" id="<?= $layout->id() ?>">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="column" style="--span:<?= $column->span(6) ?>">
	<div class="blocks">
	  <?php foreach ($column->blocks() as $block): ?>
	  <div class="block block-type-<?= $block->type() ?>">
		<?= $block ?>
	  </div>
	  <?php endforeach ?>
	</div>
  </div>
  <?php endforeach ?>
</section>
<?php endforeach ?>
CODE;
?>

```

## Passing the layout object to the block snippet

If you need to access the layout object in a block snippet, you need to pass it to the snippet manually.

```php
<?= <<<'CODE'
<?php foreach ($page->layout()->toLayouts() as $layout): ?>
<section class="6-column-grid" id="<?= $layout->id() ?>">
  <?php foreach ($layout->columns() as $column): ?>
  <div class="column" style="--span:<?= $column->span(6) ?>">
	<div class="blocks">
	  <?php foreach ($column->blocks() as $block): ?>
	  <div class="block block-type-<?= $block->type() ?>">
		<?php snippet('blocks/' . $block->type(), ['block' => $block, 'layout' => $layout]) ?>
	  </div>
	  <?php endforeach ?>
	</div>
  </div>
  <?php endforeach ?>
</section>
<?php endforeach ?>
CODE;
?>

```
