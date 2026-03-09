<?php layout('article') ?>

<?php snippet('kosmos/sidebar') ?>
<?php snippet('kosmos/header') ?>

<?php slot('toc') ?>
<?php snippet('toc', ['title' => 'In this episode']) ?>
<?php endslot() ?>

<?php snippet('kosmos/footer') ?>

