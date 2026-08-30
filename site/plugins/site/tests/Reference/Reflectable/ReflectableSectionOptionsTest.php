<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Reference\Reflectable\Tags\Parameters;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableSectionOptions::class)]
class ReflectableSectionOptionsTest extends TestCase
{
	/**
	 * Returns the options of a section, keyed by their name
	 */
	protected function options(string $section): array
	{
		$options = [];

		foreach (ReflectableSectionOptions::factory($section)->parameters() as $parameter) {
			$options[$parameter->name] = $parameter;
		}

		return $options;
	}

	public function testFactory(): void
	{
		$reflectable = ReflectableSectionOptions::factory('info');
		$this->assertSame('info', $reflectable->name);
		$this->assertInstanceOf(Parameters::class, $reflectable->parameters());
	}

	public function testParametersAreSorted(): void
	{
		$options = array_keys($this->options('info'));
		$sorted  = $options;
		sort($sorted);
		$this->assertSame($sorted, $options);
	}

	public function testParametersDescriptions(): void
	{
		// the description is the summary of the prop closure
		$option = $this->options('info')['headline'];
		$this->assertStringStartsWith(
			'The headline for the section.',
			$option->description()
		);
	}

	public function testParametersDropNullType(): void
	{
		// all options are optional, so `null` would only
		// clutter up the type column
		$option = $this->options('info')['icon'];
		$this->assertSame('string', $option->types()->toString());
		$this->assertFalse($option->types()->has('null'));
	}

	public function testParametersHaveNoPrefix(): void
	{
		// blueprint options are written without a leading `$`
		$option = $this->options('info')['headline'];
		$this->assertSame('headline', $option->name());
	}

	public function testParametersOmitValue(): void
	{
		$options = $this->options('info');
		$this->assertArrayNotHasKey('value', $options);
		$this->assertArrayHasKey('headline', $options);
	}
}
