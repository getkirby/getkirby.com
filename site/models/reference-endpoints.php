<?php

use Kirby\Cms\Field;
use Kirby\Reference\SectionPage;

class ReferenceEndpointsPage extends SectionPage
{

    public function excerpt(): Field
    {
        return parent::excerpt()->value('/api/' . $this->slug());
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'description' => 'Documentation for ' . $this->title() . ' API endpoints.',
            'thumbnail' => [
                'lead'  => 'Reference / API'
            ]
        ]);
    }

}
