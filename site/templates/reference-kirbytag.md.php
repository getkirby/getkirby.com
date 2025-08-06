<?php layout('article.md') ?>
<?php if (count($attributes) > 0): ?>
## Attributes

In addition to the main `<?= $page->slug() ?>` option, the tag supports the following attributes: <?= implode(', ', array_map(fn ($attribute) => "`{$attribute}`", $attributes)) ?>


<?php endif ?>
<?= $page->text()->convertToMarkdown() ?>
