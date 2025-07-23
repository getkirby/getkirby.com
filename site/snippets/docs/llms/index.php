# <?= site()->title() ?> Docs

> The official Kirby CMS documentation for <?= site()->title() ?>, covering Guides, Reference, Cookbook and Quicktips.

<?php snippet('docs/llms/index/guide', ['docs' => $docs->find('guide')]) ?>
****

<?php snippet('docs/llms/index/reference', ['docs' => $docs->find('reference')]) ?>
****

<?php snippet('docs/llms/index/cookbook', ['docs' => $docs->find('cookbook')]) ?>
****

<?php snippet('docs/llms/index/quicktips', ['docs' => $docs->find('quicktips')]) ?>

