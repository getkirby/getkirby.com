<?php layout('reference') ?>

<?php foreach ($kirby->collection('reference') as $group): ?>
<?php snippet('templates/reference/group', ['group' => $group]) ?>
<?php endforeach ?>
