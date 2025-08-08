<?php

use Kirby\Content\Field;
use Kirby\Template\Template;

class ReferenceUrlPage extends ReferenceArticlePage
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

	public function setup(): Field
	{
		return $this->parent()->custom()->value(function ($value) {
			return str_replace('{{ url }}', $this->slug(), $value);
		});
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
