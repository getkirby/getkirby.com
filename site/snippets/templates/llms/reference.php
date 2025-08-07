## Reference

<?php foreach ($docs->children()->listed()->not('docs/reference/tools') as $child): ?>
<?php if ($child->slug() === 'objects'): ?>
<?php snippet('templates/llms/reference/objects') ?>
<?php else: ?>
### <?= $child->title()->unhtml() . PHP_EOL ?>

<?php foreach ($child->children()->filter('intendedTemplate', '!=', 'separator')->not('docs/reference/panel/samples')->listed() as $subchild): ?>
#### <?= $subchild->title()->unhtml() . PHP_EOL ?>

<?php if ($subchild->hasChildren() && $subchild->slug() !== 'icons'): ?>
<?= markdownLinkList($subchild->children()->filter('intendedTemplate', '!=', 'separator')->listed()) ?>
<?php else: ?>
<?= markdownLink($subchild->title()->unhtml(), $subchild->markdownUrl()) ?>

<?php endif ?>

<?php endforeach ?>
<?php endif ?>
<?php endforeach ?>
