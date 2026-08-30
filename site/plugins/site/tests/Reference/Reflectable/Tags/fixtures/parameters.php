<?php

/**
 * @param mixed $e
 */
function parameters(
	string $a,
	string $b = 'bar',
	string|null $c = null,
	$d = null
) {
}

/**
 * @param mixed $a Something
 */
function parametersWithDescriptions(
) {
}

/**
 * @param $a Something
 * @param ...$rest The rest
 */
function parametersTypeless(string $a, int ...$rest)
{
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
	$d = null,
	$e = ['size' => 1, 'unit' => 'day'],
	$f = ['url', 'page', 'file'],
	$g = [['1/1'], ['1/2', '1/2']],
	$h = [2 => 'a', 5 => 'b']
) {
}