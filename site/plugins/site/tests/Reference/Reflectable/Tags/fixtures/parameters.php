<?php

/**
 * @param mixed $e
 */
function parameters(
	string $a,
	string $b = 'bar',
	string $c = null,
	$d = null
) {
}

/**
 * @param mixed $a Something
 */
function parametersWithDescriptions(
) {
}

function parametersVariadic(...$args)
{
}

/**
 * @param mixed $a
 * @param mixed $b
 */
function parametersVariadicWithDocBlock(...$args)
{
}

function parametersDefaults(
	$a,
	$b = 'foo',
	$c = [],
	$d = null
) {
}