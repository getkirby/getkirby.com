<?php layout('cookbook') ?>

<?php slot('h1') ?>
	Quicktips
<?php endslot() ?>

<?php slot('sidebar') ?>
<?php snippet('templates/quicktips/sidebar') ?>

<?php endslot() ?>
<?php slot() ?>
	<?php snippet('templates/quicktips/quicktips', [
		'quicktips' => $quicktips,
	]) ?>
<?php endslot() ?>
