<?php

use Kirby\Cms\App;
use Kirby\Marsdown\Marsdown;

return [
	/**
	 * Use our custom Marsdown parser
	 */
	'markdown' => function (
		App $kirby,
		string $text = null,
		array $options = []
	) {
		static $parser;

		$parser ??= new Marsdown();

		if (($options['inline'] ?? false) === true) {
			return @$parser->line($text);
		}

		return @$parser->text($text);
	},
];
