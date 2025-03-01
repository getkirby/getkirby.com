<?php

use Kirby\Content\Field;
use Kirby\Reference\ReferencePage;
use Kirby\Template\Template;

class ReferenceUrlPage extends ReferencePage
{
	public function example(): Field
	{
		return parent::example()->value(
			'```php' . PHP_EOL . '<?= $kirby->url(\'' . $this->slug() . '\') ?>' . PHP_EOL . '```'
		);
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / URL'
			]
		]);
	}

	public function setup(): string
	{
		$text = $this->parent()->custom()->kt()->value();
		return str_replace('{{ url }}', $this->slug(), $text);
	}

	public function template(): Template
	{
		return $this->kirby()->template('reference-system');
	}

	public function title(): Field
	{
		return parent::title()->value('$kirby->url(\'' . $this->slug() . '\')');
	}
}
