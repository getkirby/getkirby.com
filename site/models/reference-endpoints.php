<?php

use Kirby\Cms\Field;

use Kirby\Reference\ReflectionSection;

class ReferenceEndpointsPage extends ReflectionSection
{
    public function excerpt(): Field
    {
        return parent::excerpt()->value('/api/' . $this->slug());
    }

    public function metadata(): array
    {
        return [
            'description' => 'Documentation for ' . $this->title() . ' API endpoints.',
            'twittercard' => 'summary',
        ];
    }
}
