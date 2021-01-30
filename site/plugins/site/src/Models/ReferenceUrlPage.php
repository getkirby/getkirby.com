<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Page;

class ReferenceUrlPage extends Page
{

    public function title(): Field
    {
        return parent::title()->value('$kirby->url(\'' . $this->slug() . '\')');
    }

    public function example(): Field
    {
        return parent::example()->value('```php' . PHP_EOL . '<?= $kirby->url(\'' . $this->slug() . '\') ?>' . PHP_EOL . '```');
    }

    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'description' => strip_tags($this->excerpt()->kirbytags()),
        ];
    }
}
