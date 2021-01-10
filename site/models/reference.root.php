<?php

use Kirby\Cms\Field;

use Kirby\Reference\ReflectionPage;

class ReferenceRootPage extends ReflectionPage
{

    public function example(): Field
    {
        return parent::example()->value('```php' . PHP_EOL . '<?= $kirby->root(\'' . $this->slug() . '\') ?>' . PHP_EOL . '```');
    }

    public function setup(): string
    {
        $text = $this->parent()->custom()->kt()->value();
        return str_replace('{{ root }}', $this->slug(), $text);
    }

    public function template()
    {
        return $this->kirby()->template('reference.system');
    }

    public function title(): Field
    {
        return parent::title()->value('$kirby->root(\'' . $this->slug() . '\')');
    }
}
