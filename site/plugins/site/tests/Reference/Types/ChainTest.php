<?php

namespace Kirby\Reference\Types;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReferenceClassMethodPage;
use ReferenceFieldMethodPage;
use ReferenceHelperPage;

#[CoversClass(Chain::class)]
class ChainTest extends TestCase
{
	public function testToHtml(): void
	{
		// class
		$chain = new Chain('Kirby\Cms\App');
		$html  = $chain->toHtml();
		$this->assertSame('<a class="type-link" href="/docs/reference/objects/cms/app"><code class="type type-class">$kirby</code></a>', $html);

		// class method
		$chain = new Chain('$kirby->user(array $foo)');
		$html  = $chain->toHtml();
		$this->assertSame('<a class="type-link" href="/docs/reference/objects/cms/app/user"><code class="type type-method">$kirby-&gt;user(array $foo)</code></a>', $html);

		// class property
		$chain = new Chain('$kirby->user');
		$html  = $chain->toHtml();
		$this->assertSame('<code class="type type-none">$kirby-&gt;user</code>', $html);

		// field method
		$chain = new Chain('$field->esc()');
		$html  = $chain->toHtml();
		$this->assertSame('<a class="type-link" href="/docs/reference/templates/field-methods/escape"><code class="type type-method">$field-&gt;esc()</code></a>', $html);

		// helper function
		$chain = new Chain('Helper::css()');
		$html  = $chain->toHtml();
		$this->assertSame('<a class="type-link" href="/docs/reference/templates/helpers/css"><code class="type type-method">css()</code></a>', $html);
	}

	public function toHtmlNotLinked(): void
	{
		$chain = new Chain('$kirby->user()');
		$html  = $chain->toHtml();
		$this->assertSame('<code class="type type-method">$kirby->user()</code>', $html);
	}

	public function testToHtmlCustomText(): void
	{
		$chain = new Chain('Kirby\Cms\ModelWithContent::id()');
		$html  = $chain->toHtml(text: '$model->id()');
		$this->assertSame('<a class="type-link" href="/docs/reference/objects/cms/model-with-content/id"><code class="type type-method">$model-&gt;id()</code></a>', $html);
	}

	public function testToPage(): void
	{
		// class method
		$chain = new Chain('Kirby\Cms\App::user(array $foo)');
		$page  = $chain->toPage();
		$this->assertInstanceOf(ReferenceClassMethodPage::class, $page);
		$this->assertSame('docs/reference/objects/cms/app/user', $page?->id());

		// field method
		$chain = new Chain('$field->esc()');
		$page  = $chain->toPage();
		$this->assertInstanceOf(ReferenceFieldMethodPage::class, $page);
		$this->assertSame('docs/reference/templates/field-methods/escape', $page?->id());

		// helper function
		$chain = new Chain('Helper::css()');
		$page  = $chain->toPage();
		$this->assertInstanceOf(ReferenceHelperPage::class, $page);
		$this->assertSame('docs/reference/templates/helpers/css', $page?->id());

		// class property
		$chain = new Chain('$field->value');
		$page  = $chain->toPage();
		$this->assertNull($page);
	}

	public function testToString(): void
	{
		// class
		$chain  = new Chain('Kirby\Cms\App');
		$string = $chain->toString();
		$this->assertSame('$kirby', $string);

		// class method
		$chain  = new Chain('$kirby->user(array $foo)');
		$string = $chain->toString();
		$this->assertSame('$kirby->user(array $foo)', $string);

		// class property
		$chain  = new Chain('$kirby->user');
		$string = $chain->toString();
		$this->assertSame('$kirby->user', $string);

		// field method
		$chain  = new Chain('$field->esc()');
		$string = $chain->toString();
		$this->assertSame('$field->esc()', $string);

		// helper function
		$chain  = new Chain('Helper::css()');
		$string = $chain->toString();
		$this->assertSame('css()', $string);
	}
}