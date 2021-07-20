<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceUiPage extends ReflectionPage
{

    public function intro(): Field
    {
        return parent::intro()->value(html('<k-' . $this->slug() . '>'));
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'description' => 'Documentation for the ' . $this->intro() . ' Vue component.',
            'thumbnail' => [
                'lead'  => 'UI Kit',
                'title' => html_entity_decode($this->intro())
            ]
        ]);
    }

}
