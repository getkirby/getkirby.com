<?php

Use Kirby\Cms\Field;

use Kirby\Reference\ReflectionPage;

class ReferenceEndpointPage extends ReflectionPage
{

    public function metadata(): array
    {
        return [
            'description' => 'Documentation for the ' . $this->title(). ' API endpoint.',
        ];
    }

    public function request()
    {
        return $this->method() . ': ' . $this->title();
    }

    public function title(): Field
    {
        return parent::title()->value('/api' . parent::title());
    }
}
