<?php

namespace Kirby\Marsdown;

use DomDocument;
use Kirby\Reference\Types\Types;
use Kirby\Toolkit\Str;
use ParsedownExtra;

class Marsdown extends ParsedownExtra
{
	protected $lastH2;

	/**
	 * Extend Parsedown's constructor
	 */
	public function __construct(protected array $options = [])
	{
		parent::__construct();

		// register the new box type
		$this->BlockTypes['<'] = ['Box'] + $this->BlockTypes['<'];
		$this->BlockTypes['('] = ['Groups'];

		$this->setBreaksEnabled(true);
	}

	protected function parseAttributes(string $input): array
	{
		$dom = new DomDocument();
		$dom->loadHtml('<html ' . $input . '/>');
		$attributes = [];
		foreach ($dom->documentElement->attributes as $name => $attr) {
			$attributes[$name] = $attr->value;
		}
		return $attributes;
	}

	protected function blockGroups(array $Line, array $Block = null)
	{
		if (preg_match('!^\((columns|tabs)…\)$!', $Line['text'], $matches)) {
			return [
				'group' => [
					'type' => $matches[1],
					'html' => null
				]
			];
		}
	}

	protected function blockGroupsContinue(array $Line, array $Block)
	{
		if ($Block['complete'] ?? false) {
			return;
		}

		if (preg_match('!^\(…(columns|tabs)\)$!', $Line['text'])) {
			return [
				...$Block,
				'complete' => true
			];
		}

		if (isset($Block['interrupted']) === true)  {
        	$Block['group']['html'] .= "\n";
        	unset($Block['interrupted']);
        }

		$Block['group']['html'] .= "\n" . $Line['body'];

		return $Block;
	}

	protected function blockGroupsComplete(array $Block): array
	{
		return match ($Block['group']['type']) {
			'columns' => $this->blockGroupsColumnsComplete($Block),
			'tabs'    => $this->blockGroupsTabsComplete($Block),
		};
	}

	protected function blockGroupsColumnsComplete(array $Block): array
	{
		$columns = Str::split($Block['group']['html'], '++++');

		return [
			'element' => [
				'name' => 'div',
				'attributes' => [
					'class' => 'columns',
					'style' => '--columns: 2; --gap: 3rem'
				],
				'rawHtml' => snippet('kirbytext/columns', [
					'columns' => $columns
				], true),
			]
		];
	}

	protected function blockGroupsTabsComplete(array $Block): array
	{
		preg_match_all('!=== (.*)!', $Block['group']['html'], $titles);
		$contents = preg_split('!=== .*!', $Block['group']['html']);
		$tabs     = array_map(
			fn ($content, $title) => [
				'title'   => $title,
				'content' => kirbytext($content)
			],
			array_slice($contents, 1),
			$titles[1]
		);

		$id = Str::random(3);

		return [
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

	/**
	 * Parse Kirby's text boxes
	 */
	protected function blockBox(array $Line, array $Block = null)
	{
		if (preg_match('!<(success|info|warning|alert|since)(.*?)>!', $Line['text'], $matches)) {

			$type  = strtolower($matches[1]);
			$Block = [
				'box' => [
					'type'  => $type,
					'html'  => null,
					'attrs' => $this->parseAttributes($matches[2])
				],
			];

			// if the block is just across a single line
			if (preg_match('!</' . $type . '>$!', $Line['text'])) {
				$html = $Line['body'];
				$html = preg_replace('!^<' . $type . '.*?>(.*)</' . $type . '>$!', '$1', $html);

				$Block['complete']    = true;
				$Block['box']['html'] = $html;
			}

			return $Block;
		}

		return null;
	}

	/**
	 * Add lines to the boxes
	 */
	protected function blockBoxContinue(array $Line, array $Block)
	{
		if ($Block['complete'] ?? false) {
			return;
		}

		if ($Line['text'] === '</' . $Block['box']['type'] . '>') {
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
	 * Finalize the boxes
	 */
	protected function blockBoxComplete($Block)
	{
		$attrs = $Block['box']['attrs'] ?? [];
		$text  = $Block['box']['html'] ?? '';
		$type  = $Block['box']['type'] ?? 'box';

		if ($type === 'since') {
			return [
				'element' => [
					'name' => 'details',
					'rawHtml' => snippet('kirbytext/since', [
						'text'    => $text,
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
			'element' => [
				'name' => 'div',
				'rawHtml' => snippet('kirbytext/box', [
					'type'  => $type,
					'text'  => $text,
				], true),
				'attributes' => [
					'class' => 'box box--' . $type
				]
			]
		];
	}

	/**
	 * An extended version of Parsedown’s codeblock handler,
	 * offering the possibility of adding a caption (e.g. filename)
	 * to codeblocks.
	 */
	protected function blockFencedCode($Line)
	{
		$marker = $Line['text'][0];

		// Match opener
		$openerLength = strspn($Line['text'], $marker);

		if ($openerLength < 3) {
			return;
		}

		$infostring = trim(str_replace("\t", ' ', substr($Line['text'], $openerLength)), ' ');

		if (
			strpos($infostring, ' ') === false &&
			strpos($infostring, '`') !== false
		) {
			// abort parsing of block, if code block does not
			// have a caption, but language string contains
			// a backtick to match the behavior of vanilla
			// Parsedown.
			return;
		}

		$infostring = explode(' ', $infostring, 2);
		$language   = $infostring[0];

		if (sizeof($infostring) === 2) {
			// Block with caption
			$caption  = $infostring[1];
			$openChar = $caption[0];

			if ($openChar === '"') {
				$captionLength = strlen($caption);
				$lastChar      = $caption[$captionLength - 1];

				if ($lastChar === $openChar) {
					// Remove quotes surrounding caption
					$caption = substr($caption, 1, $captionLength - 2);
				}
			} else {
				// If caption was not wrapped in quotes,
				// just drop it.
				$caption = '';
			}
		} else {
			// Block without caption
			$caption = '';
		}

		// Compose the code block
		$Element = [
			'name' => 'code',
			'text' => '',
		];

		if ($language !== '') {
			$Element['attributes'] = [
				'class' => "language-{$language}"
			];
		}

		return [
			'char'         => $marker,
			'caption'      => $caption,
			'openerLength' => $openerLength,
			'language'     => $language,
			'element' => [
				'name'    => 'pre',
				'element' => $Element
			],
		];
	}

	/**
	 * Extended version of the final block handler, which
	 * adds support for filysystem code blocks, which
	 */
	protected function blockFencedCodeComplete($Block)
	{
		switch ($Block['language']) {
			case 'filesystem':
				$Block['element'] = [
					'name'       => !empty($Block['caption']) ? 'div' : 'figure',
					'attributes' => ['class' => 'filesystem'],
					'rawHtml'    => FileSystem::parse($Block['element']['element']['text']),
				];
				break;
			case 'kirbycontent':
				$Block['element']['element']['text'] = str_replace(["\r\n", "\r"], "\n", $Block['element']['element']['text']);
				break;
			default:
				$text = $Block['element']['element']['text'];
				$text = str_replace(['&lpar;', '&rpar;', '(\\'], ['(', ')', '('], $text);
				$Block['element']['element']['text'] = trim($text);
		}

		if ($Block['language'] !== 'filesystem') {

			if (empty($Block['caption']) === true) {
				$elements = [$Block['element']];
			} else {
				$elements = [
					[
						'name' => 'figcaption',
						'text' => htmlspecialchars($Block['caption']),
					],
					$Block['element']
				];
			}

			$Block['element'] = [
				'name' => 'figure',
				'attributes' => [
					'class' => 'code',
				],
				'element' => [
					'elements' => $elements
				],
			];
		}

		return $Block;
	}

	protected function blockHeader($Line)
	{
		$Block = parent::blockHeader($Line);

		if (!$Block) {
			return;
		}

		$slug  = Str::slug(Str::unhtml($this->text($Block['element']['handler']['argument'])));
		$level = $Block['element']['name'];

		switch ($level) {
			case 'h2':
				$this->lastH2 = $slug;
				break;
			case 'h3':
				$slug = $this->lastH2 . '__' . $slug;
				break;
			default:
				return $Block;
				break;
		}

		if (isset($this->options['idPrefix'])) {
			$slug = $this->options['idPrefix'] . '__' . $slug;
		}

		return [
			'element' => [
				'name' => $level,
				'attributes' => [
					'id' => $slug
				],
				'element' => [
					'name' => 'a',
					'handler' => $Block['element']['handler'],
					'nonNestables' => ['Url', 'Link'],
					'attributes' => [
						'href' => '#' . $slug
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
		$Block = [
			'element' => [
				'name' => 'div',
				'attributes' => [
					'class' => 'table',
				],
				'elements' => [$Block['element']],
			],
		];

		return $Block;
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
		return [
			[
				'rawHtml' => Types::factory($text)->toHtml(
					linked: count(array_intersect(['Url', 'Link'], $nonNestables)) === 0
				)
			]
		];
	}

}
