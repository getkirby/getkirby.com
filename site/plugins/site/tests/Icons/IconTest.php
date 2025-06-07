<?php

namespace Kirby\Icons;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Icon::class)]
class IconTest extends TestCase
{
	public function setUp(): void
	{
		Icon::$root = __DIR__ . '/fixtures';
	}

	public function tearDown(): void
	{
		Icon::$root = 'assets/icons';
	}

	public function testRenderFromLocal(): void
	{
		$icon = new Icon('test');
		$this->assertStringStartsWith('<svg width="14" height="16" viewBox="0 0 36 42" aria-hidden="true">  <path d="', $icon->render());
		$this->assertStringEndsWith('</svg>', $icon->render());
	}

	public function testRenderFromPanel(): void
	{
		$icon = new Icon('heart');
		$this->assertStringStartsWith('<svg xmlns="http://www.w3.org/2000/svg" data-type="heart" viewBox="0 0 24 24" aria-hidden="true"><path d="', $icon->render());
		$this->assertStringEndsWith('</svg>', $icon->render());
	}

	public function testRenderFromPanelReference(): void
	{
		$icon = new Icon('menu');
		$this->assertStringStartsWith('<svg xmlns="http://www.w3.org/2000/svg" data-type="bars" viewBox="0 0 24 24" aria-hidden="true"><path d="', $icon->render());
	}

	public function testRenderWithTitle(): void
	{
		// no title in SVG, provide title
		$icon = new Icon('heart', 'Like this song');
		$this->assertMatchesRegularExpression('/<svg xmlns="http:\/\/www\.w3\.org\/2000\/svg" data-type="heart" viewBox="0 0 24 24" role="img" aria-labelledby="([a-z0-9-]+)"><title id="\1">Like this song<\/title><path d="/', $icon->render());

		// title in SVG, use it
		$icon = new Icon('test-with-title');
		$this->assertStringStartsWith('<svg width="14" height="16" viewBox="0 0 36 42">  <title>Kirby CMS</title>  <path d="', $icon->render());

		// title in SVG, provide different title
		$icon = new Icon('test-with-title', 'The CMS');
		$this->assertMatchesRegularExpression('/<svg width="14" height="16" viewBox="0 0 36 42" role="img" aria-labelledby="([a-z0-9-]+)"><title id="\1">The CMS<\/title>    <path d="/', $icon->render());
	}

	public function testRenderInvalidName(): void
	{
		$icon = new Icon('foo');
		$this->assertNull($icon->render());
	}
}