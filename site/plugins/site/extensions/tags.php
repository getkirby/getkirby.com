<?php

use Kirby\Cms\App;
use Kirby\Cms\Html;
use Kirby\Cms\Section;
use Kirby\Form\Field;
use Kirby\Reference\Reflectable\ReflectableOptions;
use Kirby\Reference\Types\Chain;
use Kirby\Reference\Types\Identifier;
use Kirby\Toolkit\Str;

$coreTags = App::instance()->core()->kirbyTags();

$tags = [];

/**
 * Renders a list of fields for a given API model
 * (api-fields: page)
 */
$tags['api-fields'] = [
	'html' => function ($tag) {
		$models = $tag->kirby()->api()->models();
		$model  = $models[$tag->value] ?? [];
		$fields = array_keys($model['fields'] ?? []);

		if (empty($fields) === true) {
			return '';
		}

		$fields = array_map(function ($field) {
			return '`' . $field . '`';
		}, $fields);

		return '- ' . implode(PHP_EOL . '- ', $fields);
	}
];

/**
 * Renders a link to the Reference page for a class or class method
 * (class: Kirby\Cms\App)
 * (class: Kirby\Cms\App method: version)
 */
$tags['class'] = [
	'attr' => [
		'method',
		'text'
	],
	'html' => function ($tag) {
		$type = $tag->attr('class');
		$text = $tag->attr('text');

		// (class: foo method: bar)
		if ($tag->attr('method')) {
			$method = rtrim($tag->attr('method'), '()') . '()';
			$type  .= '::' . $method;
			return (new Chain($type))->toHtml(text: $text);
		}

		return (new Identifier($type))->toHtml(text: $text);
	}
];

/**
 * (docs: some-snippet)
 * Inserts shared doc snippets from /site/snippets/docs
 */
$tags['docs'] = [
	'attr' => [
		'field',
		'vars'
	],
	'html' => function ($tag) {
		parse_str($tag->attr('vars', ''), $vars);

		$data = [
			'page'  => $tag->parent(),
			'field' => $tag->attr('field'),
			...$vars
		];

		$snippet = snippet('docs/' . $tag->value, $data, true);

		if (($tag->options['kirbytags'] ?? true) === false) {
			return kirbytagsToMarkdown($snippet);
		}

		return kirbytext($snippet, [
			'parent' => $tag->parent()
		]);
	}
];

/**
 * Renders a list of options for a given field
 * (field-options: select)
 */
$tags['field-options'] = [
	'html' => fn ($tag) => snippet('templates/reference/entry/parameters', [
		'title'       => false,
		'reflectable' => ReflectableOptions::factory(
			type: Field::class,
			name: $tag->value
		)
	], true)
];

/**
 * (glossary: panel)
 */
$tags['glossary'] = [
	'attr' => [
		'text'
	],
	'html' => function ($tag) {
		if ($term = page('docs/glossary/' . $tag->value)) {
			$title = $term->entry()->stripGlossary()->kti();

			return '<abbr title="' . Str::unhtml($title) . '"><a href="' . $term->parent()->url() . '/#' . $term->slug() . '">' . ($tag->text ?? $term->title()) . '</a></abbr>';
		}
	}
];

/**
 * Renders a link to the helper function's Reference page
 * (helper: foo)
 */
$tags['helper'] = [
	'html' => function ($tag) {
		return kirbytag('method', 'Helper::' . $tag->value, ['text' => $tag->value . '()']);
	}
];

/**
 * (icon: icon-name)
 */
$tags['icon'] = [
	'html' => function ($tag) {
		return '<svg width="18" height="18"><use href="#icon-' . $tag->value() . '" /></svg>';
	}
];

/**
 * (image: my-screenshot.jpg)
 */
$tags['image'] = [
	'attr' => [
		'alt',
		'caption',
		'link',
		'title',
		'class'
	],
	'html' => function ($tag) {
		if ($file = $tag->file($tag->value)) {

			if (($tag->options['kirbytags'] ?? true) === false) {
				// markdown image syntax
				return '![' . ($tag->caption ?? $file->caption()->or($tag->alt)) . '](' . $file->url() . ')';
			}


			return snippet('kirbytext/image', [
				'file'    => $file,
				'class'   => $tag->class,
				'link'    => empty($tag->link) ? null : ($tag->link === 'self' ? $file->url() : $tag->link),
				'caption' => $tag->caption ?? $file->caption()->value()
			], true);
		}
	}
];

/**
 * (kirby-version: major offset: -1)
 */
$tags['kirby-version'] = [
	'attr' => [
		'offset'
	],
	'html' => function ($tag) {
		list($major, $minor, $patch) = explode('.', App::version());

		// optional relative offsets for major-only versions
		if ($tag->value() === 'major') {
			return $major + ($tag->offset() ?? 0);
		}

		// treat the version parts as placeholders in the input string
		return str_replace(
			['major', 'minor', 'patch'],
			[$major, $minor, $patch],
			$tag->value()
		);
	}
];

/**
 * Core (link:) tag with support for Marsdown magic
 */
$tags['link'] = [
	...$coreTags['link'],
	'html' => function ($tag) use ($coreTags) {
		if (($tag->options['kirbytags'] ?? true) === false) {
			if ($page = page($tag->value())) {
				return markdownLink($tag->text() ?? $tag->value(), $page->markdownUrl());
			}

			return markdownLink($tag->text() ?? $tag->value(), url($tag->value()));
		}

		return $coreTags['link']['html']($tag);
	}
];

/**
 * Renders a link to the Reference page for a class method
 * (method: Kirby\Cms\App::version)
 */
$tags['method'] = [
	'attr' => [
		'text'
	],
	'html' => function ($tag) {
		$method = rtrim($tag->attr('method'), '()') . '()';
		$text   = $tag->attr('text');

		return (new Chain($method))->toHtml(text: $text);
	}
];

/**
 * Used for replacing nested glossary tags
 */
$tags['plain'] = [
	'attr' => [
		'text'
	],
	'html' => fn ($tag) => $tag->text ?? $tag->value
];

/**
 * (quote: Lorem Ipsum author: Homer Simpson)
 */
$tags['quote'] = [
	'attr' => [
		'author',
		'link'
	],
	'html' => function ($tag) {
		$html = '<blockquote><p class="mb-1">' . $tag->value() . '</p>';

		if ($author = $tag->author()) {
			if ($link = $tag->link()) {
				$author = '<a href="' . $link .'" class="link">' . $author . '</a>';
			}

			$html .= '<footer>– ' . $author . '</footer>';
		}

		return $html. '</blockquote>';
	}
];

/**
 * (reference: templates/field-methods)
 * Renders a grid of all children of the reference page
 */
$tags['reference'] = [
	'html' => function ($tag) {
		if ($page = page('docs/reference/' . $tag->value())) {
			$snippet = 'kirbytext/reference';

			if (($tag->options['kirbytags'] ?? true) === false) {
				$snippet = 'kirbytext/reference.md';
			}

			return snippet($snippet, [
				'entries' => $page->children()->listed()
			], true);
		}
	}
];

/**
 * (screencast: https://www.youtube.com/watch?v=EDVYjxWMecc poster: youtube.jpg title: How to install Kirby in 5 minutes)
 */
$tags['screencast'] = [
	'attr' => [
		'poster',
		'title',
		'text',
	],
	'html' => function ($tag) {
		$snippet = 'kirbytext/screencast';

		if (($tag->options['kirbytags'] ?? true) === false) {
			$snippet = 'kirbytext/screencast.md';
		}

		return snippet($snippet, [
			'url'    => $tag->value,
			'poster' => $tag->poster ? $tag->file($tag->poster) : $tag->file('youtube.jpg'),
			'title'  => $tag->title ?? null,
			'text'   => $tag->text ?? null
		], true);
	}
];

/**
 * Renders a list of options for a given section
 * (section-options: pages)
 */
$tags['section-options'] = [
	'html' => fn ($tag) => snippet('templates/reference/entry/parameters', [
		'title'       => false,
		'reflectable' => ReflectableOptions::factory(
			type: Section::class,
			name: $tag->value
		)
	], true)
];

/**
 * (snippet: snippet/to/render/the/children)
 */
$tags['snippet'] = [
	'html' => fn ($tag) => snippet($tag->value(), [], true)
];

/**
 * Enhanced video tag
 */
$tags['video'] = [
	'attr' => [
		'autoplay',
		'caption',
		'controls',
		'class',
		'disablepictureinpicture',
		'height',
		'loop',
		'muted',
		'playsinline',
		'poster',
		'preload',
		'style',
		'width',
	],
	'html' => function ($tag) {
		// checks and gets if poster is local file
		if (
			empty($tag->poster) === false &&
			Str::startsWith($tag->poster, 'http://') !== true &&
			Str::startsWith($tag->poster, 'https://') !== true
		) {
			if ($poster = $tag->file($tag->poster)) {
				$tag->poster = $poster->url();
			}
		}

		// checks video is local or provider(remote)
		$isLocalVideo = (
			Str::startsWith($tag->value, 'http://') !== true &&
			Str::startsWith($tag->value, 'https://') !== true
		);
		$isProviderVideo = (
			$isLocalVideo === false &&
			(
				Str::contains($tag->value, 'youtu', true) === true ||
				Str::contains($tag->value, 'vimeo', true) === true
			)
		);

		// default attributes for local and remote videos
		$attrs = [
			'height' => $tag->height,
			'width'  => $tag->width
		];

		// don't use attributes that iframe doesn't support
		if ($isProviderVideo === false) {
			// convert tag attributes to supported formats (bool, string)
			// to output correct html attributes
			//
			// for ex:
			// `autoplay` will not work if `false` is a string
			// instead of a boolean
			$attrs['autoplay']    = $autoplay = Str::toType($tag->autoplay, 'bool');
			$attrs['controls']    = Str::toType($tag->controls ?? true, 'bool');
			$attrs['disablepictureinpicture'] = Str::toType($tag->disablepictureinpicture ?? false, 'bool');
			$attrs['loop']        = Str::toType($tag->loop, 'bool');
			$attrs['muted']       = Str::toType($tag->muted ?? $autoplay, 'bool');
			$attrs['playsinline'] = Str::toType($tag->playsinline ?? $autoplay, 'bool');
			$attrs['poster']      = $tag->poster;
			$attrs['preload']     = $tag->preload;
		}

		// handles local and remote video file
		if ($isLocalVideo === true) {
			// handles local video file
			if ($tag->file = $tag->file($tag->value)) {
				$source = Html::tag('source', '', [
					'src'  => $tag->file->url(),
					'type' => $tag->file->mime()
				]);
				$video = Html::tag('video', [$source], $attrs);
			}
		} else {
			$video = video(
				$tag->value,
				$tag->poster ? $tag->file($tag->poster) : $tag->file('youtube.jpg'),
				$tag->kirby()->option('kirbytext.video.options', []),
				$attrs
			);
		}

		return Html::figure([$video ?? ''], $tag->caption, [
			'class' => $tag->class ?? 'video',
			'style' => $tag->style
		]);
	}
];

return $tags;
