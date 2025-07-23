## <?= $title . PHP_EOL ?>

<?php if ($text): ?>
<?= $text . PHP_EOL ?>
<?php endif ?>

<?php if ($poster): ?>
![](<?= $poster->url() ?>)
<?php endif ?>

[Watch the screencast](<?= $url ?>)
