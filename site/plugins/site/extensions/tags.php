<?php

use Kirby\Cms\Html;
use Kirby\Cms\Section;
use Kirby\Form\Field;
use Kirby\Reference\DocBlock;
use Kirby\Reference\Types;
use Kirby\Toolkit\Str;

$tags = [];

/**
 * (snippet: snippet/to/render/the/children)
 */
$tags['snippet'] = [
	'html' => fn ($tag) => snippet($tag->value(), [], true)
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
 * (screencast: https://www.youtube.com/watch?v=EDVYjxWMecc poster: youtube.jpg title: How to install Kirby in 5 minutes)
 */
$tags['screencast'] = [
	'attr' => [
		'poster',
		'title',
		'text',
	],
	'html' => function ($tag) {
		return snippet('kirbytext/screencast', [
			'url'    => $tag->value,
			'poster' => $tag->poster ? $tag->file($tag->poster) : $tag->file('youtube.jpg'),
			'title'  => $tag->title ?? null,
			'text'   => $tag->text ?? null
		], true);
	}
];

/**
 * (glossary: panel)
 */
$tags['glossary'] = [
	'attr' => ['text'],
	'html' => function ($tag) {
		if ($term = page('docs/glossary/' . $tag->value)) {
			$title = $term->entry()->stripGlossary()->kti();

			return '<abbr title="' . Str::unhtml($title) . '"><a href="' . $term->parent()->url() . '/#' . $term->slug() . '">' . ($tag->text ?? $term->title()) . '</a></abbr>';
		}
	}
];

/**
 * (reference: templates/field-methods)
 * Renders a grid of all children of the reference page
 */
$tags['reference'] = [
	'html' => function ($tag) {
		if ($page = page('docs/reference/' . $tag->value())) {
			return snippet('kirbytext/reference', [
				'entries' => $page->children()->listed()
			], true);
		}
	}
];

/**
 * Used for replacing nested glossary tags
 */
$tags['plain'] = [
	'attr' => ['text'],
	'html' => fn ($tag) => $tag->text ?? $tag->value
];

/**
 * (docs: some-snippet)
 * Injects shared doc snippets from site/snippets/docs
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

		return kirbytext($snippet, [
			'parent' => $tag->parent()
		]);
	}
];


/**
 * Enhanced link tag with support for automatic
 * linking to Reference pages
 */
$tags['class'] = $tags['method'] = [
	'attr' => [
		'method',
		'text'
	],
	'html' => function ($tag) {
		$type = rtrim($tag->value, '()');
		$text = $tag->attr('text');

		// (class: foo method: bar)
		if ($tag->attr('class') && $tag->attr('method')) {
			$type .= '::' . $tag->attr('method');

			if ($text === null) {
				$parts = Str::split($tag->attr('class'), '\\');
				$name  = array_pop($parts);
				$text  = $name . '->' . $tag->attr('method') . '()';
			}
		}

		$text ??= $type . '()';

		return Types::format($type, true, trim($text));
	}
];

$tags['helper'] = [

	'html' => function ($tag) {
		return kirbytag('method', 'Helper::' . $tag->value, ['text' => $tag->value . '()']);
	}
];

// @todo All the following should be refactored, but this requires
// content file changes, so we wait

/**
 * Fetch prop definitions from Fields and Sections
 * and create an options table for it.
 *
 * @param array $definition
 * @return array
 * @todo refactor/deprecate
 */
function toOptions(array $props)
{
	$table = [];

	foreach ($props as $attr => $prop) {

		if ($attr === 'value') {
			continue;
		}

		if (is_callable($prop) === false) {
			continue;
		}

		$reflection = new ReflectionFunction($prop);
		$parameter  = $reflection->getParameters()[0] ?? null;
		$comment    = null;

		try {
			$default = $parameter->getDefaultValue();
		} catch (Exception $e) {
			$default = null;
		}

		if ($docComment = $reflection->getDocComment()) {
			try {
				$docBlock = new DocBlock($docComment);
				$comment  = trim($docBlock->getSummary());
				$comment  = str_replace(PHP_EOL, ' ', $comment);

				if ($comment === '/') {
					$comment = null;
				}

			} catch (Throwable $e) {
			}
		}

		if (is_array($default) === true) {
			$default = '[]';
		}

		if ($default === true) {
			$default = 'true';
		}

		if ($default === false) {
			$default = 'false';
		}

		$type = $parameter->getType();
		$parameterType = null;

		if ($type) {
			if ($type instanceof ReflectionUnionType) {
				$parameterTypes = [];

				foreach ($type->getTypes() as $unionType) {
					$parameterTypes[] = $unionType->getName();
				}

				$parameterType = join('|', $parameterTypes);
			} else {
				$parameterType = $type->getName();
			}
		}

		$table[$attr] = [
			'name'        => $attr,
			'required'    => $parameter->isOptional() !== true,
			'type'        => $parameterType,
			'default'     => $default,
			'description' => $comment,
		];
	}

	ksort($table);

	return $table;

}

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

$tags['field-options'] = [
	'html' => function ($tag) {
		$type       = $tag->value;
		$definition = Field::setup($type);
		$props      = $definition['props'] ?? [];
		$table      = toOptions($props);

		return snippet('templates/reference/entry/parameters', [
			'title' => false,
			'rows'  => $table
		], true);
	}
];

$tags['section-options'] = [
	'html' => function ($tag) {
		$type       = $tag->value;
		$definition = Section::setup($type);
		$props      = $definition['props'] ?? [];
		$table      = toOptions($props);

		return snippet('templates/reference/entry/parameters', [
			'title' => false,
			'rows' => $table
		], true);
	}
];

$tags['video'] = [
	'attr' => [
		'autoplay',
		'caption',
		'controls',
		'class',
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
			// converts tag attributes to supported formats (listed below) to output correct html
			// booleans: autoplay, controls, loop, muted
			// strings : poster, preload
			// for ex  : `autoplay` will not work if `false` is a `string` instead of a `boolean`
			$attrs['autoplay']    = $autoplay = Str::toType($tag->autoplay, 'bool');
			$attrs['controls']    = Str::toType($tag->controls ?? true, 'bool');
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
				$video = Html::video(
					$tag->file->url(),
					$tag->kirby()->option('kirbytext.video.options', []),
					$attrs
				);
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
