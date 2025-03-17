<?php

use Kirby\Cms\Permissions;

$permissions = (new Permissions())->toArray();
?>

```yaml "/site/blueprints/users/editor.yml"
title: Editor
permissions:
<?php foreach ($permissions as $key => $value): ?>
<?= '  ' . $key ?>:
<?php foreach ($value as $action => $allowed): ?>
<?= '    ' . $action ?>: <?= $allowed ? 'true' : 'false' ?><?= PHP_EOL ?>
<?php endforeach ?>
<?php endforeach ?>
```