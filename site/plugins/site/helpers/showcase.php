<?php

use Kirby\Http\Remote;
use Kirby\Toolkit\A;

function showcase(
	string $category,
	bool|null $featured = null,
	bool $shuffle = true,
	int|null $limit = null
): array {

	$api = 'https://madewith.getkirby.com/for/' . $category . '.json';

	if ($featured !== null) {
		$api .= '?filtered=' . ($featured === true ? 'true' : 'false');
	}

	$causes = Remote::get($api)->json();

	if ($shuffle !== false) {
		$causes = A::shuffle($causes);
	}

	if ($limit !== null) {
		$causes = array_slice($causes, 0, $limit);
	}

	return $causes;

}
