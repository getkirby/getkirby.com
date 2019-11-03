| Alias | Full class |
|--|--|
<?php
$aliases = require $kirby->root('kirby') . '/config/aliases.php';
foreach ($aliases as $alias => $class) :
?>
|`<?= ucfirst($alias) ?>`|`<?= $class ?>`|
<?php endforeach ?>
