# <?= $site->title() ?> Docs

> The official Kirby CMS documentation for <?= $site->title() ?>, covering Guides, Reference, Cookbook and Quicktips.

<?php snippet('templates/llms/guide', ['docs' => $docs->find('guide')]) ?>
****

<?php snippet('templates/llms/reference', ['docs' => $docs->find('reference')]) ?>
****

<?php snippet('templates/llms/cookbook', ['docs' => $docs->find('cookbook')]) ?>
****

<?php snippet('templates/llms/quicktips', ['docs' => $docs->find('quicktips')]) ?>
****

<?php snippet('templates/llms/glossary', ['docs' => $docs->find('glossary')]) ?>
