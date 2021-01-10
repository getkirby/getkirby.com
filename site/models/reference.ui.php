<?php

use Kirby\Cms\Field;

use Kirby\Reference\ReflectionPage;

class ReferenceUiPage extends ReflectionPage
{

    public function excerpt(): Field
    {
        return parent::excerpt()->value(html('<k-' . $this->slug() . '>'));
    }

    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'description' => 'Documentation for the <k-' . $this->slug() . '> Vue component.',
        ];
    }
}
