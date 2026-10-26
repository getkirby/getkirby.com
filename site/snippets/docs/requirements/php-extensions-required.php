- Either the `gd` extension or `ImageMagick` (see below)
<?php

// required extensions as checked by the Kirby core
foreach (array_keys($kirby->system()->extensions()) as $extension) {
	echo '- `' . $extension . '`' . PHP_EOL;
}
