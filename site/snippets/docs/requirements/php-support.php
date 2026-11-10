<?php

use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

// supported PHP versions per Kirby version,
// from the requirements page
$rows = page('docs/reference/system/requirements')->phpsupport()->yaml();
$rows = A::map($rows, fn ($row) => [
	'kirby' => $row['kirby'],
	'php'   => Str::split((string)$row['php'])
]);

// all PHP versions, newest first
$versions = array_unique(array_merge(...array_column($rows, 'php')));
rsort($versions, SORT_NATURAL);

echo '| Kirby | PHP ' . implode(' | PHP ', $versions) . ' |' . PHP_EOL;
echo '| --- |' . str_repeat(' :---: |', count($versions)) . PHP_EOL;

foreach ($rows as $row) {
	$cells = A::map($versions, fn ($version) => in_array($version, $row['php'], true) ? '✅' : '');
	echo '| ' . $row['kirby'] . ' | ' . implode(' | ', $cells) . ' |' . PHP_EOL;
}
