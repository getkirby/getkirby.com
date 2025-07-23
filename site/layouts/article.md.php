# <?= $page->title() . PHP_EOL ?>
<?php if ($page->intro()->isNotEmpty()): ?>

<?= $page->intro()->convertToMarkdown() . PHP_EOL ?>

****
<?php endif ?>
<?php if ($page->screencast()->isNotEmpty()): ?>

<?= $page->screencast()->convertToMarkdown() ?>

****
<?php endif ?>

<?php if ($page->text()->isNotEmpty()): ?>
<?= $page->text()->convertToMarkdown() ?>
<?php endif ?>

<?php if ($page->resources()->toPages()->isNotEmpty()): ?>
## Additional resources

<?php foreach ($page->resources()->toPages() as $resource): ?>
- [<?= $resource->title()->nohtml() ?>](<?= $resource->menuUrl() ?>)
<?php endforeach ?>
<?php endif ?>

