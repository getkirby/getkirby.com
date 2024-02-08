<?php

require_once __DIR__ . '/vendor/autoload.php';

if (function_exists('oauth') === false) {
	function oauth()
	{
		return new Kirby\OAuth\OAuth();
	}
}
