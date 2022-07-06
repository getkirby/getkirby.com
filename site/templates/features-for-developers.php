<?php layout('features') ?>

<?php snippet('templates/features-for-developers/filesystem') ?>
<?php snippet('templates/features-for-developers/techstack') ?>
<?php snippet('templates/features-for-developers/templating') ?>
<?php snippet('templates/features-for-developers/security') ?>
<?php snippet('templates/features-for-developers/headless') ?>
<?php snippet('templates/features-for-developers/features') ?>
<?php snippet('templates/features-for-developers/plugins') ?>
<?php snippet('templates/features-for-developers/support') ?>
<?php snippet('templates/features/more', [
  'features' => [
	'routes',
	'cache',
	'email',
	'languages',
	'publish-workflow',
	'authentication',
	'virtual-pages',
	'hooks',
	'content-representations',
	'multi-site'
  ]
]) ?>
