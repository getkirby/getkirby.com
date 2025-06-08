<?php

use Kirby\Content\Field;

/**
 * Reads a CSV file
 */
function csv(string $file): array
{
	$handle = fopen($file, "r");
	$lines  = [];

	while(($line = fgetcsv($handle)) !== false) {
		$lines[] = $line;
	}

	$lines[0] = str_replace("\xEF\xBB\xBF", '', $lines[0]);

	array_walk($lines, fn (&$a) => $a = array_combine($lines[0], $a));
	array_shift($lines);

	return $lines;
}

/**
 * Creates a Field object from a value
 */
function field($value): Field
{
	if ($value instanceof Field) {
		return $value;
	}

	$field = page()->customField();

	if ($value !== null) {
		return $field->value($value);
	}

	return $field;
}
