<?php

use Kirby\Content\Field;

/**
 * Reads a CSV file
 */
function csv(string $file): array
{
	$handle = fopen($file, "r");
	$lines  = [];

	if ($handle === false) {
		return $lines;
	}

	while (($line = fgetcsv($handle, escape: '\\')) !== false) {
		$lines[] = $line;
	}

	fclose($handle);

	if (count($lines) === 0) {
		return $lines;
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
