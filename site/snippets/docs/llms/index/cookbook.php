## Cookbook

<?php foreach ($docs->children()->listed() as $child): ?>
### <?= $child->title()->unhtml() . PHP_EOL ?>

<?php foreach ($child->children()->listed() as $subchild): ?>
- [<?= $subchild->title()->unhtml() ?>](<?= $subchild->markdownUrl() ?>)
<?php endforeach ?>

<?php endforeach ?>
