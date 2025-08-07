### Objects

<?php foreach (page('docs/reference/objects')->children()->unlisted() as $namespace): ?>
#### <?= $namespace->title() ?>


<?php foreach ($namespace->children()->listed() as $class): ?>
- <?= markdownLink($class->reflection()->name(), $class->markdownUrl()) . PHP_EOL ?>
<?php endforeach ?>

<?php endforeach ?>
