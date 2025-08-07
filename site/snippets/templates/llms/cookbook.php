## Cookbook

<?php foreach (collection('cookbook/categories') as $child): ?>
### <?= $child->title()->unhtml() . PHP_EOL ?>

<?= markdownLinkList($child->children()->listed()) ?>

<?php endforeach ?>
