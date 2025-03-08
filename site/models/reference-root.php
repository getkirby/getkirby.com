<?php

use Kirby\Content\Field;
use Kirby\Template\Template;

class ReferenceRootPage extends ReferenceArticlePage
{
	public function example(): Field
	{
		return parent::example()->value(
			'```php' . PHP_EOL . '<?= $kirby->root(\'' . parent::title() . '\') ?>' . PHP_EOL . '```'
		);
	}

	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'thumbnail' => [
				'lead'  => 'Reference / Roots'
			]
		]);
	}

	public function setup(): string
	{
		$text = $this->parent()->custom()->kt()->value();
		return str_replace('{{ root }}', parent::title(), $text);
	}

	public function template(): Template
	{
		return $this->kirby()->template('reference-system');
	}

	public function title(): Field
	{
		return parent::title()->value(
			'$kirby->root(\'' . parent::title() . '\')'
		);
	}
}
