### Objects

<?php foreach ($children as $child): ?>
#### Kirby\<?= $child->title()->unhtml()->ucfirst() ?>


<?php foreach ($child->children()->listed() as $subchild): ?>
- [<?= $subchild->reflection()->name() ?>](<?= $subchild->markdownUrl() ?>)
<?php endforeach ?>

<?php endforeach ?>
