<?php

namespace Kirby\Reference\Reflectable;

use Exception;
use Kirby\Form\Field\TextField;
use Kirby\Reference\Reflectable\Tags\Parameters;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReflectableFieldOptions::class)]
class ReflectableFieldOptionsTest extends TestCase
{
	/**
	 * Returns the options of a field, keyed by their name
	 */
	protected function options(string $field): array
	{
		$options = [];

		foreach (ReflectableFieldOptions::factory($field)->parameters() as $parameter) {
			$options[$parameter->name] = $parameter;
		}

		return $options;
	}

	public function testFactory(): void
	{
		$reflectable = ReflectableFieldOptions::factory('text');
		$this->assertSame('text', $reflectable->name);
		$this->assertSame(TextField::class, $reflectable->class);
		$this->assertInstanceOf(Parameters::class, $reflectable->parameters());
	}

	public function testFactoryWithLegacyField(): void
	{
		// `legacy-*` fields still point to an array definition file
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Field "legacy-text" not found');
		ReflectableFieldOptions::factory('legacy-text');
	}

	public function testFactoryWithUnknownField(): void
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('Field "doesNotExist" not found');
		ReflectableFieldOptions::factory('doesNotExist');
	}

	public function testParametersAreSorted(): void
	{
		$options = array_keys($this->options('text'));
		$sorted  = $options;
		sort($sorted);
		$this->assertSame($sorted, $options);
	}

	public function testParametersDescriptions(): void
	{
		// the description lives in the doc block of the property
		$option = $this->options('text')['icon'];
		$this->assertSame(
			'Optional icon that will be shown at the end of the field',
			$option->description()
		);
	}

	public function testParametersDropNullType(): void
	{
		// all options are optional, so `null` would only
		// clutter up the type column
		$option = $this->options('text')['icon'];
		$this->assertSame('string', $option->types()->toString());
		$this->assertFalse($option->types()->has('null'));
	}

	public function testParametersHaveNoPrefix(): void
	{
		// blueprint options are written without a leading `$`
		$option = $this->options('text')['width'];
		$this->assertSame('width', $option->name());
	}

	public function testParametersOmitName(): void
	{
		// the name isn't written as an option;
		// it comes from the blueprint key
		$options = $this->options('text');
		$this->assertArrayNotHasKey('name', $options);
		$this->assertArrayHasKey('placeholder', $options);
	}

	public function testParametersReadDefaultsFromGetters(): void
	{
		$options = $this->options('text');

		// the constructor default is `null`, the getter
		// resolves the actual default
		$this->assertSame("'1/1'", $options['width']->default());
		$this->assertSame('true', $options['counter']->default());
		$this->assertSame('false', $options['required']->default());
	}

	public function testParametersWithoutStaticDefault(): void
	{
		$options = $this->options('text');

		// `label` is derived from the field itself, so there
		// is no static default to document
		$this->assertNull($options['label']->default());

		// `icon` has no getter default at all
		$this->assertSame('null', $options['icon']->default());
	}
}
