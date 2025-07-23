## Guide

<?php foreach (collection('guides')->group('category') as $category => $item): ?>
## <?= option('categories')[$category] ?? ucfirst($category) ?>


<?php foreach ($item as $guide): ?>
- [<?= $guide->title()->unhtml() ?>](<?= $guide->menuUrl() ?>.md)
<?php endforeach ?>

<?php endforeach ?>
