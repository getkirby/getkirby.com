<?php foreach ($entries as $entry): ?>
- [<?= $entry->title()->unhtml() ?>](<?= $entry->markdownUrl() ?>)
<?php endforeach ?>
