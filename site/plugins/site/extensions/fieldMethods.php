<?php

use Kirby\Http\Url;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;
use Kirby\Toolkit\Str;

return [
	/**
	 * Shorten the URL
	 */
	'shortUrl' => function ($field) {
		return $field->value(fn ($value) => Url::short(Url::base($value)));
	},
	/**
	 * Convert glossary tags to plain text
	 */
	'stripGlossary' => function ($field) {
		return $field->value(
			fn ($value) => str_replace('(glossary:', '(plain:', $value ?? '')
		);
	},
	/**
	 * Extract headlines from the field value and return a collection of them
	 */
	'toToc' => function ($field, string $headline = 'h2') {
		$value = $field->value() ?? '';

		// Make sure not to include sceencast boxes
		$value = preg_replace('$\(screencast:.*\)$', '', $value);

		preg_match_all(
			'!<' . $headline . '.*?>(.*?)</' . $headline . '>!s',
			$field->value($value)->kt()->value(),
			$matches
		);

		$headlines = new Collection();

		foreach ($matches[1] as $text) {
			$headline = new Obj([
				'id'   => '#' . Str::slug(Str::unhtml($text)),
				'text' => trim(strip_tags($text)),
			]);

			$headlines->append($headline->id(), $headline);
		}

		return $headlines;
	},
];
