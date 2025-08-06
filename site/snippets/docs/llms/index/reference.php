## Reference

<?php foreach ($docs->children()->listed() as $child): ?>
<?php if ($child->slug() === 'objects'): ?>
<?php snippet('docs/llms/index/reference/objects', ['children' => $child->childrenUnfiltered()]) ?>
<?php else: ?>
### <?= $child->title()->unhtml() . PHP_EOL ?>

<?php foreach ($child->children()->filter('intendedTemplate', '!=', 'separator')->listed() as $subchild): ?>
#### <?= $subchild->title()->unhtml() . PHP_EOL ?>

<?php if ($subchild->hasChildren()): ?>
<?php foreach ($subchild->children()->filter('intendedTemplate', '!=', 'separator')->listed() as $subsubchild): ?>
- [<?= $subsubchild->title()->unhtml() ?>](<?= $subsubchild->markdownUrl() ?>)
<?php endforeach ?>
<?php else: ?>
- [<?= $subchild->title()->unhtml() ?>](<?= $subchild->markdownUrl() ?>)
<?php endif ?>

<?php endforeach ?>
<?php endif ?>
<?php endforeach ?>
