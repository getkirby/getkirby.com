<?php

use Kirby\Filesystem\F;

$types   = F::$types[$field] ?? [];
$exclude = explode(',', $exclude ?? '');
?>

<?php foreach ($types as $extension) : ?>
<?php if (in_array($extension, $exclude) === false) : ?>
- <?= $extension . PHP_EOL ?>
<?php endif ?>
<?php endforeach ?>
