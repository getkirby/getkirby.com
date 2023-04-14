<?php

use Kirby\Cms\Field;

function csv(string $file): array
{
    $lines    = file($file);
    $lines[0] = str_replace("\xEF\xBB\xBF", '', $lines[0]);

    $csv = array_map('str_getcsv', $lines);

    array_walk($csv, function(&$a) use ($csv) {
        $a = array_combine($csv[0], $a);
    });

    array_shift($csv);

    return $csv;
}

function field($value): Field {
    if ($value === null) {
        return page()->customField();
    }

    if ($value instanceof Field === false) {
        $value = page()->customField()->value($value);
    }

    return $value;
}