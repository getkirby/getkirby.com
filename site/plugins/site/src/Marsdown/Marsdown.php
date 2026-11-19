<?php

namespace Kirby\Marsdown;

use Kirby\Reference\Types\Type;
use Kirby\Reference\Types\Types;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use ParsedownExtra;

class Marsdown extends ParsedownExtra
{
	/**
	 * Heading ids used in the document so far
	 */
	protected array $ids = [];

	/**
	 * Id of the last h2 heading, used to prefix h3 ids
	 */
	protected string|null $lastH2 = null;

	/**
	 * @param $root Root parser of the document, if this
	 *             parser renders nested content (boxes, columns, tabs)
	 */
	public function __construct(
		protected array $options = [],
		protected Marsdown|null $root = null
	) {
		parent::__construct();

		// register the new box type
		$this->BlockTypes['<'] = ['Box'] + $this->BlockTypes['<'];
		$this->BlockTypes['('] = ['Groups'];

		$this->setBreaksEnabled(true);
	}

	/**
	 * Parse Kirby's text boxes, e.g. `<info>…</info>`
	 * or `<since v="5.0.0">…</since>`
	 */
	protected function blockBox(array $Line, array|null $Block = null)
	{
		if (preg_match('!^<(success|info|warning|alert|since)(\s[^>]*)?>(.*)$!', $Line['text'], $matches) !== 1) {
			return null;
		}

		$type  = $matches[1];
		$text  = rtrim($matches[3]);
		$Block = [
			'box' => [
				'type'  => $type,
				'html'  => $text,
				'attrs' => $this->parseAttributes($matches[2])
			],
		];

		// single-line box
		if (str_ends_with($text, '</' . $type . '>') === true) {
			$Block['complete']    = true;
			$Block['box']['html'] = substr($text, 0, -strlen('</' . $type . '>'));
		}

		return $Block;
	}

	/**
	 * Finalize the boxes
	 */
	protected function blockBoxComplete($Block)
	{
		$attrs = $Block['box']['attrs'] ?? [];
		$text  = $Block['box']['html'] ?? '';
		$type  = $Block['box']['type'] ?? 'box';

		if ($type === 'since') {
			return [
				...$Block,
				'element' => [
					'name' => 'details',
					'rawHtml' => snippet('kirbytext/since', [
						'html'    => $this->nested($text),
						'label'   => $attrs['label'] ?? null,
						'version' => $attrs['v'] ?? null
					], true),
					'attributes' => [
						'class' => 'since list-none',
						'open' => true
					]
				]
			];
		}

		return [
			...$Block,
			'element' => [
				'name' => 'div',
				'rawHtml' => snippet('kirbytext/box', [
					'type' => $type,
					'html' => $this->nested($text),
				], true),
				'attributes' => [
					'class' => 'box box--' . $type
				]
			]
		];
	}

	/**
	 * Add lines to the boxes
	 */
	protected function blockBoxContinue(array $Line, array $Block)
	{
		if ($Block['complete'] ?? false) {
			return;
		}

		if (rtrim($Line['text']) === '</' . $Block['box']['type'] . '>') {
			$Block['complete'] = true;
			return $Block;
		}

		if (isset($Block['interrupted'])) {
			$Block['box']['html'] .= str_repeat("\n", $Block['interrupted']);
			unset($Block['interrupted']);
		}

		$Block['box']['html'] .= "\n" . $Line['body'];

		return $Block;
	}

	/**
	 * Fenced code blocks with an optional quoted
	 * caption, e.g. ```php "site/config/config.php"
	 */
	protected function blockFencedCode($Line)
	{
		$caption = null;

		// separate the caption, so that Parsedown only gets
		// the language as info string (tolerating a missing
		// closing quote, so that typos stay visible)
		if (preg_match('!^([`~]{3,}\s*\S*)\s+"([^"]*)"?\s*$!', $Line['text'], $matches) === 1) {
			$Line['text'] = $matches[1];
			$caption      = $matches[2] !== '' ? $matches[2] : null;
		}

		$Block = parent::blockFencedCode($Line);

		if ($Block !== null) {
			$Block['caption']  = $caption;
			$Block['language'] = strtok(substr($Line['text'], $Block['openerLength']), " \t") ?: null;
		}

		return $Block;
	}

	/**
	 * Wraps code blocks in a figure with optional caption
	 * and renders `filesystem` blocks as file tree
	 */
	protected function blockFencedCodeComplete($Block)
	{
		$code = rtrim(ltrim($Block['element']['element']['text'], "\n"));

		if ($Block['language'] === 'filesystem') {
			$element = [
				'name'       => 'figure',
				'attributes' => ['class' => 'filesystem'],
				'rawHtml'    => FileSystem::parse($code),
			];

			// without caption, the tree is the figure itself
			if ($Block['caption'] === null) {
				$Block['element'] = $element;
				return $Block;
			}

			$element['name'] = 'div';
		} else {
			// unescape KirbyTags in code examples, e.g. `(\link: …)`
			$element = $Block['element'];
			$element['element']['text'] = str_replace(['&lpar;', '&rpar;', '(\\'], ['(', ')', '('], $code);
		}

		$elements = [$element];

		if ($Block['caption'] !== null) {
			array_unshift($elements, ['name' => 'figcaption', 'text' => $Block['caption']]);
		}

		$Block['element'] = [
			'name'       => 'figure',
			'attributes' => ['class' => 'code'],
			'elements'   => $elements
		];

		return $Block;
	}

	/**
	 * Parse groups: `(columns…)` with `++++` separators
	 * or `(tabs…)` with `=== Title` separators
	 */
	protected function blockGroups(array $Line, array|null $Block = null)
	{
		if (preg_match('!^\((columns|tabs)…\)$!', rtrim($Line['text']), $matches) !== 1) {
			return null;
		}

		return [
			'group' => [
				'type'  => $matches[1],
				'depth' => 0,
				'parts' => [['title' => null, 'text' => '']]
			]
		];
	}

	protected function blockGroupsColumnsComplete(array $Block): array
	{
		$columns = [];

		foreach ($Block['group']['parts'] as $part) {
			if (trim($part['text']) !== '') {
				$columns[] = $this->nested($part['text']);
			}
		}

		return [
			...$Block,
			'element' => [
				'name' => 'div',
				'attributes' => [
					'class' => 'columns',
					'style' => '--columns: 2; --gap: 3rem'
				],
				'rawHtml' => snippet('kirbytext/columns', [
					'html' => $columns
				], true),
			]
		];
	}

	protected function blockGroupsComplete(array $Block): array
	{
		return match ($Block['group']['type']) {
			'columns' => $this->blockGroupsColumnsComplete($Block),
			'tabs'    => $this->blockGroupsTabsComplete($Block),
		};
	}

	protected function blockGroupsContinue(array $Line, array $Block)
	{
		if ($Block['complete'] ?? false) {
			return;
		}

		$text = rtrim($Line['text']);
		$last = array_key_last($Block['group']['parts']);

		if (isset($Block['interrupted']) === true) {
			$Block['group']['parts'][$last]['text'] .= str_repeat("\n", $Block['interrupted']);
			unset($Block['interrupted']);
		}

		if (preg_match('!^\(…(columns|tabs)\)$!', $text) === 1) {
			// end of this group, unless it closes a nested group
			if ($Block['group']['depth'] === 0) {
				$Block['complete'] = true;
				return $Block;
			}

			$Block['group']['depth']--;
		} elseif (preg_match('!^\((columns|tabs)…\)$!', $text) === 1) {
			$Block['group']['depth']++;
		} elseif ($Block['group']['depth'] === 0) {
			// separators only count on their own line
			// and not inside of nested groups
			$title = match ($Block['group']['type']) {
				'columns' => $text === '++++' ? '' : null,
				'tabs'    => str_starts_with($text, '=== ') ? trim(substr($text, 4)) : null
			};

			if ($title !== null) {
				$Block['group']['parts'][] = ['title' => $title, 'text' => ''];
				return $Block;
			}
		}

		$Block['group']['parts'][$last]['text'] .= "\n" . $Line['body'];

		return $Block;
	}

	protected function blockGroupsTabsComplete(array $Block): array
	{
		// content before the first tab title is ignored
		$tabs = A::map(
			array_slice($Block['group']['parts'], 1),
			fn ($part) => [
				'title' => $part['title'],
				'html'  => $this->nested($part['text'])
			]
		);

		// stable id across renders
		$id = hash('crc32b', json_encode($tabs));

		return [
			...$Block,
			'element' => [
				'name' => 'div',
				'attributes' => [
					'class' => 'tabs',
					'id'    => 'tabs-' . $id
				],
				'rawHtml' => snippet('kirbytext/tabs', [
					'id'   => $id,
					'tabs' => $tabs,
				], true),
			]
		];
	}

	protected function blockHeader($Line)
	{
		$Block = parent::blockHeader($Line);
		$level = $Block['element']['name'] ?? null;

		// only h2 and h3 headings get ids and anchor links
		if ($level !== 'h2' && $level !== 'h3') {
			return $Block;
		}

		// custom ids (`## Heading {#id}`) are used as they are
		$attrs = $Block['element']['attributes'] ?? [];
		$id    = $attrs['id'] ?? $this->headingId($level, $Block['element']['handler']['argument']);
		$state = $this->root ?? $this;

		$state->ids[$id] = true;

		if ($level === 'h2') {
			$state->lastH2 = $id;
		}

		if (isset($attrs['id']) === false && isset($this->options['idPrefix']) === true) {
			$id = $this->options['idPrefix'] . '__' . $id;
		}

		return [
			...$Block,
			'element' => [
				'name' => $level,
				'attributes' => [
					...$attrs,
					'id' => $id
				],
				'element' => [
					'name' => 'a',
					'handler' => $Block['element']['handler'],
					'nonNestables' => ['Url', 'Link'],
					'attributes' => [
						'href'     => '#' . $id,
						'tabindex' => '-1'
					]
				]
			]
		];
	}

	/**
	 * Wrap tables in a div
	 */
	protected function blockTableComplete($Block)
	{
		$Block['element'] = [
			'name'       => 'div',
			'attributes' => ['class' => 'table'],
			'elements'   => [$Block['element']],
		];

		return $Block;
	}

	/**
	 * Creates an id for a h2 or h3 heading from its text,
	 * unique within the document; h3 ids are prefixed
	 * with the id of the last h2
	 */
	protected function headingId(string $level, string $text): string
	{
		$state = $this->root ?? $this;

		// slug from the plain text of the heading, without
		// a leading number (e.g. `### 1. First step`) to keep
		// existing ids; using `line()` as `text()` would
		// reset the link definitions of the document
		$text = preg_replace('/^\d+[.)] +/', '', $text);
		$slug = Str::slug(Str::unhtml($this->line($text)));

		if ($level === 'h3') {
			$slug = $state->lastH2 . '__' . $slug;
		}

		$id = $slug;

		for ($n = 2; isset($state->ids[$id]) === true; $n++) {
			$id = $slug . '-' . $n;
		}

		return $id;
	}

	/**
	 * Highlight data types in inline code
	 */
	protected function inlineCode($Excerpt)
	{
		$Excerpt = parent::inlineCode($Excerpt);

		if ($Excerpt !== null) {
			return [
				...$Excerpt,
				'element' => [
					'nonNestables' => ['Code'],
					'handler' => [
						'function' => 'inlineCodeHandler',
						'argument' => $Excerpt['element']['text'],
						'destination' => 'elements'
					]
				],
			];
		}
	}

	protected function inlineCodeHandler($text, $nonNestables = [])
	{
		// Only split into multiple types for unions (e.g. `string|int`),
		// keep any other code with pipes (e.g. `foo(Bar|Baz $a): Bar|Foo`)
		// together as a single code tag
		$type = match ($this->isTypeUnion($text)) {
			true  => Types::fromString($text),
			false => Type::factory($text)
		};

		return [
			[
				'rawHtml' => $type->toHtml(
					// Use text as provided
					text: $text,
					// Don't link if the code is  already nested in alink
					linked:
						in_array('Url', $nonNestables) === false &&
						in_array('Link', $nonNestables) === false
				)
			]
		];
	}

	/**
	 * Checks if the inline code is a union of types
	 */
	protected function isTypeUnion(string $text): bool
	{
		$types = Types::split($text);

		// no empty types or whitespace around the pipes
		if (implode('|', $types) !== $text) {
			return false;
		}

		// each type must be a single token, only allowing
		// whitespace nested in brackets, e.g. `array<string, mixed>`
		return A::every(
			$types,
			fn ($type) => count(Types::split($type, ' ')) === 1
		);
	}

	/**
	 * Parses the content of boxes, columns and tabs with
	 * a separate parser, so that it does not reset the
	 * definitions of the outer document
	 */
	protected function nested(string $text): string
	{
		return (new static($this->options, $this->root ?? $this))->text($text);
	}

	/**
	 * Parses quoted HTML attributes, e.g. `v="5.0.0" label='%s'`
	 */
	protected function parseAttributes(string $input): array
	{
		preg_match_all('!([\w-]+)=(["\'])(.*?)\2!', $input, $matches, PREG_SET_ORDER);

		$attributes = [];

		foreach ($matches as [, $name, , $value]) {
			$attributes[strtolower($name)] = html_entity_decode($value);
		}

		return $attributes;
	}

	/**
	 * Parses a document
	 */
	public function text($text): string
	{
		// every document starts with a clean state;
		// nested content shares the state of its root
		if ($this->root === null) {
			$this->ids    = [];
			$this->lastH2 = null;
		}

		return parent::text($text);
	}
}
