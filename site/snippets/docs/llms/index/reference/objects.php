### Objects

<?php foreach ($children as $child): ?>
#### Kirby\<?= $child->title()->unhtml()->ucfirst() ?>


<?= markdownLinkList($child->children()->listed()) ?>

<?php endforeach ?>
