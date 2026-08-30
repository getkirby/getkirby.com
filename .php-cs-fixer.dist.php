<?php

return Kirby\PhpCs\Config::create()->setFinder(
	PhpCsFixer\Finder::create()
		->exclude([
			'accounts',
			'cache',
			'sessions',
			'fixtures'
		])
		->in(__DIR__ . '/site')
);
