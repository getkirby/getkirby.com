<?php foreach ($meta as $name => $content): ?>
<meta name="<?= $name ?>" content="<?= $content ?>">
<?php endforeach ?>

<?php foreach ($og as $prop => $content): ?>
<meta property="<?= $prop ?>" content="<?= $content ?>">
<?php endforeach ?>
