<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class ReferenceEndpointsPage extends Page
{

    public function metadata(): array
    {
        return [
            'description' => 'Documentation for ' . parent::title() . ' API endpoints.',
            'twittercard' => 'summary',
        ];
    }
}
