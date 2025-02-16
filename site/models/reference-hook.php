<?php

use Kirby\Content\Field;
use Kirby\Reference\ReferencePage;
use Kirby\Reference\Reflectable\Tags\Parameter;
use Kirby\Reference\Reflectable\Tags\Parameters;
use Kirby\Reference\Types\Types;
use Kirby\Toolkit\A;

class ReferenceHookPage extends ReferencePage
{
	public function example(): Field
	{
		$tab    = '    ';
		$args   = $this->arguments();
		$return = $this->return()->or($args);

		$example[] = '```php "/site/config/config.php"';
		$example[] = 'return [';
		$example[] = $tab . "'hooks' => [";
		$example[] = $tab . $tab . "'" . $this->title() . "' => function ($args) {";
		$example[] = $tab . $tab . $tab . '// your code goes here';

		if ($this->type() == 'apply') {
			$example[] =  $tab . $tab . $tab . 'return ' . $return . ';';
		}

		$example[] = $tab . $tab . '}';
		$example[] = $tab . ']';
		$example[] = ']';
		$example[] = '```';

		return parent::example()->value(implode(PHP_EOL, $example));
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'description' => 'Reference page for the hook ' . $this->title(),
			'thumbnail' => [
				'lead'  => 'Reference / Hooks'
			]
		]);
	}

	public function parameters(): Parameters
	{
		$parameters = $this->arguments()->split();
		$parameters = A::map($parameters, function ($parameter) {
			$parameter = explode('=', $parameter);
			$parameter = explode(' ', trim($parameter[0]));

			return new Parameter(
				name: ltrim($parameter[count($parameter) - 1], '$'),
				types: Types::factory($parameter[count($parameter) - 2] ?? 'null')
			);
		});

		return new Parameters($parameters);
	}
}
