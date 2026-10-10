<?php

return Kirby\PhpCs\Config::create()->setFinder(
	PhpCsFixer\Finder::create()
		->exclude('accounts')
		->exclude('cache')
		->exclude('sessions')
		->exclude('fixtures')
		->notPath('config/keys.php')
		->in(__DIR__ . '/site')
		->append([__DIR__ . '/index.php'])
);
