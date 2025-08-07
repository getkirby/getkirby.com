## Guide

<?php foreach (collection('guides')->group('category') as $category => $items): ?>
### <?= option('categories')[$category] ?? ucfirst($category) ?>


<?= markdownLinkList($items) ?>

<?php endforeach ?>
