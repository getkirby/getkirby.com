<?php

use Kirby\Cms\App;
use Kirby\Marsdown\Marsdown;

return [
	/**
	 * Use our custom Marsdown parser
	 * (a fresh one for each text, as it keeps
	 * per-document state like the heading ids)
	 */
	'markdown' => function (
		App $kirby,
		string|null $text = null,
		array $options = []
	) {
		$parser = new Marsdown($options);

		// silenced like in Kirby's own markdown component,
		// so that a notice from Parsedown cannot take down a page
		// (the tests use Marsdown directly and fail on any warning)
		if (($options['inline'] ?? false) === true) {
			return @$parser->line($text ?? '');
		}

		return @$parser->text($text ?? '');
	},
];
