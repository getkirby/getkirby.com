<?php

namespace Kirby\Reference\Types;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Compound::class)]
class CompoundTest extends TestCase
{
	public function testBase(): void
	{
		$this->assertSame('list', (new Compound('list<int>'))->base());
		$this->assertSame('array', (new Compound('array{a: int}'))->base());
		$this->assertSame('callable', (new Compound('callable(int): bool'))->base());
		$this->assertSame('Kirby\Cms\Page', (new Compound('Kirby\Cms\Page[]'))->base());
	}

	public static function kindProvider(): array
	{
		return [
			['list<int>', 'array'],
			['non-empty-list<int>', 'array'],
			['array{a: int}', 'array'],
			['array<string, int>', 'array'],
			['class-string<static>', 'string'],
			['callable(int): bool', 'callable'],
			['Kirby\Cms\Page[]', 'array'],
			['Kirby\Cms\Collection<int>', 'class'],
			['foo<int>', null],
		];
	}

	#[DataProvider('kindProvider')]
	public function testKind(string $type, string|null $expected): void
	{
		$this->assertSame($expected, (new Compound($type))->kind());
	}

	public function testToHtml(): void
	{
		$type = new Compound('array<string, Kirby\Cms\App>');
		$this->assertSame('<code class="type type-compound type-array">array&lt;string, <a href="/docs/reference/objects/cms/app">Kirby\Cms\App</a>&gt;</code>', $type->toHtml());

		// classes without reference page
		$type = new Compound('list<Foo\Bar>');
		$this->assertSame('<code class="type type-compound type-array">list&lt;Foo\Bar&gt;</code>', $type->toHtml());
	}

	public function testToHtmlNotLinked(): void
	{
		$type = new Compound('array<string, Kirby\Cms\App>');
		$this->assertSame('<code class="type type-compound type-array">array&lt;string, Kirby\Cms\App&gt;</code>', $type->toHtml(linked: false));
	}

	public function testToHtmlWithText(): void
	{
		$type = new Compound('array<string, Kirby\Cms\App>');
		$this->assertSame('<code class="type type-compound type-array">a &lt;b&gt;</code>', $type->toHtml(text: 'a <b>'));
	}

	public function testToString(): void
	{
		$type = new Compound('array{files: Kirby\Cms\Files, page: Kirby\Cms\Page|null}');
		$this->assertSame('array{files: Kirby\Cms\Files, page: Kirby\Cms\Page|null}', $type->toString());
		$this->assertSame('array{files: Files, page: Page|null}', $type->toString(short: true));

		$type = new Compound('callable(Kirby\Cms\Page $page): bool');
		$this->assertSame('callable(Page $page): bool', $type->toString(short: true));
	}
}
