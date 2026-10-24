<?php

use Kirby\Toolkit\Str;

// PHP versions of the current Kirby version,
// from the support history on the requirements page
$current     = page('docs/reference/system/requirements')->phpsupport()->yaml()[0];
$recommended = (string)($current['recommended'] ?? '');

foreach (Str::split((string)$current['php']) as $version) {
	echo '- PHP ' . $version . ($version === $recommended ? ' (recommended)' : '') . PHP_EOL;
}
