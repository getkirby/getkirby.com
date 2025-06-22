<?php

namespace Kirby\Reference\Types;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReferenceClassPage;

#[CoversClass(Identifier::class)]
class IdentifierTest extends TestCase
{
	public function testToHtml(): void
	{
		// unknown
		$identifier = new Identifier('Foo');
		$this->assertSame('<code class="type">Foo</code>', $identifier->toHtml());

		// PHP default class
		$identifier = new Identifier('stdClass');
		$this->assertSame('<code class="type type-class">stdClass</code>', $identifier->toHtml());

		// existing Kirby class
		$identifier = new Identifier('Kirby\Cms\App');
		$this->assertSame('<a class="type-link" href="/docs/reference/objects/cms/app"><code class="type type-class">Kirby\Cms\App</code></a>', $identifier->toHtml());

		// existing Kirby class with leading backslash
		$identifier = new Identifier('\Kirby\Cms\App');
		$this->assertSame('<a class="type-link" href="/docs/reference/objects/cms/app"><code class="type type-class">Kirby\Cms\App</code></a>', $identifier->toHtml());
	}

	public function testToHtmlWithText(): void
	{
		$identifier = new Identifier('Kirby\Cms\App');
		$this->assertSame('<a class="type-link" href="/docs/reference/objects/cms/app"><code class="type type-class">my text</code></a>', $identifier->toHtml(text: 'my text'));
	}

	public function testToHtmlNotLinked(): void
	{
		$identifier = new Identifier('Kirby\Cms\App');
		$this->assertSame('<code class="type type-class">Kirby\Cms\App</code>', $identifier->toHtml(linked: false));
	}

	public function testToPage(): void
	{
		$identifier = new Identifier('Kirby\Cms\App');
		$page       = $identifier->toPage();
		$this->assertInstanceOf(ReferenceClassPage::class, $page);
		$this->assertSame('docs/reference/objects/cms/app', $page->id());

		$identifier = new Identifier('stdClass');
		$page       = $identifier->toPage();
		$this->assertNull($page);

		$identifier = new Identifier('Page');
		$page       = $identifier->toPage();
		$this->assertInstanceOf(ReferenceClassPage::class, $page);
		$this->assertSame('docs/reference/objects/cms/page', $page->id());
	}

	public function testToString(): void
	{
		$identifier = new Identifier('\Kirby\Cms\App');
		$this->assertSame('Kirby\Cms\App', $identifier->toString());

		$identifier = new Identifier('Page');
		$this->assertSame('Kirby\Cms\Page', $identifier->toString());
	}}