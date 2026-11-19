<?php

namespace Kirby\Marsdown;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Marsdown::class)]
class MarsdownTest extends TestCase
{
	protected function parse(string $text, array $options = []): string
	{
		return (new Marsdown($options))->text($text);
	}

	public function testBox(): void
	{
		$html = $this->parse("<info>\nSome **bold** text\n</info>");
		$this->assertStringStartsWith('<div class="box box--info">', $html);
		$this->assertStringContainsString('<div class="box-icon iconbox bg-black color-white"><svg', $html);
		$this->assertStringContainsString('<p>Some <strong>bold</strong> text</p>', $html);
		$this->assertStringEndsWith('</div>', $html);
	}

	public function testBoxClosingTagWithTrailingWhitespace(): void
	{
		$html = $this->parse("<info>\nBox\n</info>  \n\nAfter");
		$this->assertStringContainsString('<p>Box</p>', $html);
		$this->assertStringEndsWith("</div>\n<p>After</p>", $html);

		$html = $this->parse("<info>Box</info>  \nAfter");
		$this->assertStringContainsString('<p>Box</p>', $html);
		$this->assertStringEndsWith("</div>\n<p>After</p>", $html);
	}

	public function testBoxFollowedByText(): void
	{
		$html = $this->parse("<info>\nBox\n</info>\n\nAfter");
		$this->assertStringStartsWith('<div class="box box--info">', $html);
		$this->assertStringEndsWith("</div>\n<p>After</p>", $html);

		$html = $this->parse("<info>Box</info>\nAfter");
		$this->assertStringEndsWith("</div>\n<p>After</p>", $html);
	}

	public function testBoxIndented(): void
	{
		// used to recurse endlessly
		$html = $this->parse('  <info>Hi</info>');
		$this->assertStringStartsWith('<div class="box box--info">', $html);
		$this->assertStringContainsString('<p>Hi</p>', $html);
	}

	public function testBoxOnlyAtLineStart(): void
	{
		// other tags starting with a box name
		$this->assertSame(
			'<information-panel>Hi</information-panel>',
			$this->parse('<information-panel>Hi</information-panel>')
		);

		// box tag later in the line
		$this->assertSame(
			'<p><span>see</span> <info>Hi</info></p>',
			$this->parse('<span>see</span> <info>Hi</info>')
		);
	}

	public function testBoxSingleLine(): void
	{
		$html = $this->parse('<warning>Careful</warning>');
		$this->assertStringStartsWith('<div class="box box--warning">', $html);
		$this->assertStringContainsString('<p>Careful</p>', $html);
	}

	public function testBoxSuccessIcon(): void
	{
		$html = $this->parse('<success>Done</success>');
		$this->assertStringStartsWith('<div class="box box--success">', $html);
		$this->assertStringContainsString('data-type="smile"', $html);
	}

	public function testBoxWithBlankLines(): void
	{
		$html = $this->parse("<alert>\nFirst\n\nSecond\n</alert>");
		$this->assertStringStartsWith('<div class="box box--alert">', $html);
		$this->assertStringContainsString('<p>First</p>', $html);
		$this->assertStringContainsString('<p>Second</p>', $html);
	}

	public function testBoxWithKirbyTags(): void
	{
		// KirbyTags are parsed once for the whole text,
		// the box content isn't run through KirbyText again
		$html = kirby()->kirbytext("<info>\n(link: https://getkirby.com text: Kirby)\n</info>");
		$this->assertSame(1, substr_count($html, '<a href="https://getkirby.com">Kirby</a>'));

		$html = $this->parse("<info>\n(link: https://getkirby.com)\n</info>");
		$this->assertStringContainsString('<p>(link: <a href="https://getkirby.com">https://getkirby.com</a>)</p>', $html);
	}

	public function testBoxWithTextInOpeningLine(): void
	{
		$html = $this->parse("<info>First line\nSecond line\n</info>");
		$this->assertStringContainsString("<p>First line<br />\nSecond line</p>", $html);
	}

	public function testBreaks(): void
	{
		$this->assertSame("<p>a<br />\nb</p>", $this->parse("a\nb"));
	}

	public function testColumns(): void
	{
		$html = $this->parse("(columns…)\nLeft\n\n++++\n\nRight\n(…columns)");
		$this->assertStringStartsWith('<div class="columns" style="--columns: 2; --gap: 3rem">', $html);
		$this->assertSame(1, substr_count($html, '<p>Left</p>'));
		$this->assertSame(1, substr_count($html, '<p>Right</p>'));
		$this->assertLessThan(strpos($html, 'Right'), strpos($html, 'Left'));
	}

	public function testColumnsFollowedByText(): void
	{
		$html = $this->parse("(columns…)\nLeft\n++++\nRight\n(…columns)\n\nAfter");
		$this->assertStringEndsWith("</div>\n<p>After</p>", $html);
	}

	public function testDefinitionsWithHeadingsAndBoxes(): void
	{
		$this->assertSame(
			'<p><a href="https://getkirby.com">Kirby</a></p>' . "\n" .
			'<h2 id="later"><a href="#later" tabindex="-1">Later</a></h2>',
			$this->parse("[Kirby][k]\n\n[k]: https://getkirby.com\n\n## Later")
		);

		$html = $this->parse("[Kirby][k]\n\n[k]: https://getkirby.com\n\n<info>\nBox\n</info>");
		$this->assertStringStartsWith('<p><a href="https://getkirby.com">Kirby</a></p>', $html);
	}

	public function testFencedCode(): void
	{
		$this->assertSame(
			"<figure class=\"code\">\n<pre><code class=\"language-php\">&lt;?php echo 1;</code></pre>\n</figure>",
			$this->parse("```php\n<?php echo 1;\n```")
		);
	}

	public function testFencedCodeKeepsInnerIndentation(): void
	{
		$this->assertSame(
			"<figure class=\"code\">\n<pre><code class=\"language-yaml\">fields:\n  text: true</code></pre>\n</figure>",
			$this->parse("```yaml\nfields:\n  text: true\n```")
		);
	}

	public function testFencedCodeUnescapesKirbyTags(): void
	{
		$this->assertSame(
			"<figure class=\"code\">\n<pre><code class=\"language-php\">(link: x)\n(image: y)</code></pre>\n</figure>",
			$this->parse("```php\n(\\link: x)\n&lpar;image: y&rpar;\n```")
		);
	}

	public function testFencedCodeWithCaption(): void
	{
		$this->assertSame(
			"<figure class=\"code\">\n<figcaption>site/config/config.php</figcaption>\n<pre><code class=\"language-php\">return [];</code></pre>\n</figure>",
			$this->parse("```php \"site/config/config.php\"\nreturn [];\n```")
		);
	}

	public function testFencedCodeWithoutLanguage(): void
	{
		$this->assertSame(
			"<figure class=\"code\">\n<pre><code>plain</code></pre>\n</figure>",
			$this->parse("```\nplain\n```")
		);
	}

	public function testFencedCodeWithUnquotedCaption(): void
	{
		// unquoted captions are dropped
		$this->assertSame(
			"<figure class=\"code\">\n<pre><code class=\"language-php\">x</code></pre>\n</figure>",
			$this->parse("```php site/config/config.php\nx\n```")
		);
	}

	public function testFilesystem(): void
	{
		$html = $this->parse("```filesystem\ncontent/\n  home.txt\n```");
		$this->assertStringStartsWith('<figure class="filesystem"><ul><li><details open><summary>', $html);
		$this->assertStringContainsString('data-type="folder-expanded"', $html);
		$this->assertStringContainsString('>home.txt</span>', $html);
		$this->assertStringEndsWith('</ul></figure>', $html);
	}

	public function testHeadingH2(): void
	{
		$this->assertSame(
			'<h2 id="hello-world"><a href="#hello-world" tabindex="-1">Hello World</a></h2>',
			$this->parse('## Hello World')
		);
	}

	public function testHeadingH3(): void
	{
		$this->assertSame(
			'<h2 id="foo"><a href="#foo" tabindex="-1">Foo</a></h2>' . "\n" .
			'<h3 id="foo__bar"><a href="#foo__bar" tabindex="-1">Bar</a></h3>',
			$this->parse("## Foo\n\n### Bar")
		);
	}

	public function testHeadingIdsAreResetForEachDocument(): void
	{
		$parser = new Marsdown();
		$parser->text("## Foo\n\ntext");

		// no prefix from the h2 of the previous document
		$this->assertSame(
			'<h3 id="__bar"><a href="#__bar" tabindex="-1">Bar</a></h3>',
			$parser->text('### Bar')
		);

		// not counted as a duplicate of the previous document
		$this->assertSame(
			'<h2 id="foo"><a href="#foo" tabindex="-1">Foo</a></h2>',
			$parser->text('## Foo')
		);
	}

	public function testHeadingIdsAreUnique(): void
	{
		$html = $this->parse("## Options\n\n### Example\n\n## Options\n\n### Example\n\n<info>\n## Options\n</info>");
		$this->assertSame(1, substr_count($html, '<h2 id="options">'));
		$this->assertSame(1, substr_count($html, '<h3 id="options__example">'));
		$this->assertSame(1, substr_count($html, '<h2 id="options-2">'));
		$this->assertSame(1, substr_count($html, '<h3 id="options-2__example">'));
		$this->assertSame(1, substr_count($html, '<h2 id="options-3">'));
	}

	public function testHeadingIdsInNestedContent(): void
	{
		$html = $this->parse("## Foo\n\n<info>\n### Bar\n</info>\n\n(columns…)\n## Baz\n++++\n### Qux\n(…columns)\n\n### Quux");
		$this->assertStringContainsString('<h3 id="foo__bar">', $html);
		$this->assertStringContainsString('<h2 id="baz">', $html);
		$this->assertStringContainsString('<h3 id="baz__qux">', $html);
		$this->assertStringContainsString('<h3 id="baz__quux">', $html);
	}

	public function testHeadingOtherLevels(): void
	{
		$this->assertSame(
			"<h1>One</h1>\n<h4>Four</h4>",
			$this->parse("# One\n\n#### Four")
		);
	}

	public function testHeadingWithCustomId(): void
	{
		$this->assertSame(
			'<h2 id="custom" class="big"><a href="#custom" tabindex="-1">Foo</a></h2>' . "\n" .
			'<h3 id="custom__bar"><a href="#custom__bar" tabindex="-1">Bar</a></h3>' . "\n" .
			'<h2 id="custom-2"><a href="#custom-2" tabindex="-1">Custom</a></h2>',
			$this->parse("## Foo {#custom .big}\n\n### Bar\n\n## Custom")
		);

		// custom ids don't get the id prefix
		$this->assertSame(
			'<h2 id="custom"><a href="#custom" tabindex="-1">Foo</a></h2>',
			$this->parse('## Foo {#custom}', ['idPrefix' => 'v5'])
		);
	}

	public function testHeadingWithIdPrefix(): void
	{
		$this->assertSame(
			'<h2 id="v5__foo"><a href="#v5__foo" tabindex="-1">Foo</a></h2>' . "\n" .
			'<h3 id="v5__foo__bar"><a href="#v5__foo__bar" tabindex="-1">Bar</a></h3>',
			$this->parse("## Foo\n\n### Bar", ['idPrefix' => 'v5'])
		);
	}

	public function testHeadingWithInlineCode(): void
	{
		// slug from the plain text, no links nested in the heading link
		$html = $this->parse('## The `Kirby\Cms\App` class');
		$this->assertSame('<h2 id="the-kirby-cms-app-class"><a href="#the-kirby-cms-app-class" tabindex="-1">The <code class="type type-class">Kirby\Cms\App</code> class</a></h2>', $html);
	}

	public function testInlineCode(): void
	{
		$this->assertSame(
			'<p><code class="type">foo</code></p>',
			$this->parse('`foo`')
		);
	}

	public function testInlineCodeInLink(): void
	{
		$this->assertSame(
			'<p><a href="https://getkirby.com"><code class="type type-class">Kirby\Cms\App</code></a></p>',
			$this->parse('[`Kirby\Cms\App`](https://getkirby.com)')
		);
	}

	public function testInlineCodeLinked(): void
	{
		$this->assertSame(
			'<p><a class="type-link" href="/docs/reference/objects/cms/app"><code class="type type-class">Kirby\Cms\App</code></a></p>',
			$this->parse('`Kirby\Cms\App`')
		);
	}

	public function testInlineCodeTypeUnion(): void
	{
		$this->assertSame(
			'<p><code class="type type-string">string</code><span class="px-1 color-gray-400" aria-hidden="true">|</span><span class="sr-only">or</span><code class="type type-null">null</code></p>',
			$this->parse('`string|null`')
		);
	}

	public function testInlineCodeWithPipesButNoUnion(): void
	{
		$this->assertSame(
			'<p><code class="type type-compound">foo(Bar|Baz $a)</code></p>',
			$this->parse('`foo(Bar|Baz $a)`')
		);

		$this->assertSame(
			'<p><code class="type">a | b</code></p>',
			$this->parse('`a | b`')
		);
	}

	public function testSince(): void
	{
		$html = $this->parse('<since v="4.0.0">New thing</since>');
		$this->assertStringStartsWith('<details class="since list-none" open="1">', $html);
		$this->assertStringContainsString('Since <a href="https://github.com/getkirby/kirby/releases/tag/4.0.0">4.0.0</a>', $html);
		$this->assertStringContainsString('<p>New thing</p>', $html);
	}

	public function testSinceWithLabel(): void
	{
		$html = $this->parse("<since v=\"4.0.0\" label=\"Kirby %s\">\nNew thing\n</since>");
		$this->assertStringContainsString('Since <a href="https://github.com/getkirby/kirby/releases/tag/4.0.0">Kirby 4.0.0</a>', $html);
		$this->assertStringContainsString('<p>New thing</p>', $html);
	}

	public function testSinceWithSingleQuotes(): void
	{
		$html = $this->parse("<since v='4.0.0'>New thing</since>");
		$this->assertStringContainsString('Since <a href="https://github.com/getkirby/kirby/releases/tag/4.0.0">4.0.0</a>', $html);
	}

	public function testSnippetsWithKirbyText(): void
	{
		// the snippets render KirbyText themselves
		// if they don't get rendered HTML from Marsdown
		$html = snippet('kirbytext/box', ['type' => 'info', 'text' => '**Box**'], true);
		$this->assertStringContainsString('<p><strong>Box</strong></p>', $html);

		$html = snippet('kirbytext/since', ['version' => '4.0.0', 'text' => '**Since**'], true);
		$this->assertStringContainsString('<p><strong>Since</strong></p>', $html);

		$html = snippet('kirbytext/columns', ['text' => ['**Left**', '**Right**']], true);
		$this->assertStringContainsString('<p><strong>Left</strong></p>', $html);
		$this->assertStringContainsString('<p><strong>Right</strong></p>', $html);

		$html = snippet('kirbytext/tabs', ['id' => 'abc', 'tabs' => [['title' => 'A', 'text' => '**Tab**']]], true);
		$this->assertStringContainsString('<p><strong>Tab</strong></p>', $html);
	}

	public function testTable(): void
	{
		$html = $this->parse("| a | b |\n|---|---|\n| 1 | 2 |");
		$this->assertStringStartsWith("<div class=\"table\">\n<table>\n<thead>", $html);
		$this->assertStringContainsString('<td>1</td>', $html);
		$this->assertStringEndsWith("</table>\n</div>", $html);
	}

	public function testTableFollowedByText(): void
	{
		$html = $this->parse("| a | b |\n|---|---|\n| 1 | 2 |\n\nAfter");
		$this->assertStringEndsWith("</table>\n</div>\n<p>After</p>", $html);
	}

	public function testTabs(): void
	{
		$html = $this->parse("(tabs…)\n=== PHP\nfoo\n=== JS\nbar\n(…tabs)");
		$this->assertMatchesRegularExpression('/^<div class="tabs" id="tabs-([a-zA-Z0-9]+)"><nav role="tablist">/', $html);
		$this->assertMatchesRegularExpression('/role="tab"[^>]*>\s*PHP\s*<\/button>/', $html);
		$this->assertMatchesRegularExpression('/role="tab"[^>]*>\s*JS\s*<\/button>/', $html);
		$this->assertMatchesRegularExpression('/role="tabpanel"\s*>\s*<p>foo<\/p><\/div>/', $html);
		$this->assertMatchesRegularExpression('/role="tabpanel"\s*>\s*<p>bar<\/p><\/div>/', $html);
		$this->assertStringContainsString('<script type="module">', $html);
	}
}
