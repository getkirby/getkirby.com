- Either the `gd` or the `imagick` extension (see below)
<?php

// required extensions as checked by the Kirby core
foreach (array_keys($kirby->system()->extensions()) as $extension) {
	echo '- `' . $extension . '`' . PHP_EOL;
}
