<?php layout('features') ?>

<?php snippet('templates/features-for-designers/workflow') ?>
<?php snippet('templates/features-for-designers/interface') ?>
<?php snippet('templates/features-for-designers/prototyping') ?>

<?php snippet('templates/features/more', [
  'features' => [
    'panel',
    'field-blocks',
    'plugins',
    'languages',
    'users',
    'assets',
    'templates',
    'publish-workflow',
    'cookbook',
    'docs'
  ]
]) ?>
