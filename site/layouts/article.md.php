# <?= $page->title()->unhtml() . PHP_EOL ?>
<?php if ($slots->intro() || $page->intro()->isNotEmpty()): ?>

<?= $slots->intro() ?? $page->intro()->convertToMarkdown() . PHP_EOL ?>

****
<?php endif ?>
<?php if ($page->screencast()->isNotEmpty()): ?>

<?= $page->screencast()->convertToMarkdown() ?>

****
<?php endif ?>

<?php if ($slot != ''): ?>
<?= $slot ?>
<?php elseif ($page->text()->isNotEmpty()): ?>
<?= $page->text()->convertToMarkdown() ?>
<?php endif ?>

<?php if ($page->resources()->toPages()->isNotEmpty()): ?>
## Additional resources

<?php foreach ($page->resources()->toPages() as $resource): ?>
- [<?= $resource->title()->nohtml() ?>](<?= $resource->menuUrl() ?>)
<?php endforeach ?>
<?php endif ?>

