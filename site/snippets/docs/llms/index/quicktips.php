## Quicktips

<?php foreach ($docs->children()->listed() as $child): ?>
- [<?= $child->title()->unhtml() ?>](<?= $child->menuUrl() ?>.md)
<?php endforeach ?>
