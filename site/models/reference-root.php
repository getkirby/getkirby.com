<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;
use Kirby\Template\Template;

class ReferenceRootPage extends ReflectionPage
{
    public function example(): Field
    {
        return parent::example()->value('```php' . PHP_EOL . '<?= $kirby->root(\'' . $this->slug() . '\') ?>' . PHP_EOL . '```');
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
        return str_replace('{{ root }}', $this->slug(), $text);
    }

    public function template(): Template
    {
        return $this->kirby()->template('reference-system');
    }

    public function title(): Field
    {
        return parent::title()->value('$kirby->root(\'' . $this->slug() . '\')');
    }
}
