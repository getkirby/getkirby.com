<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Page;

class ReferenceEndpointPage extends Page
{
    public function metadata(): array
    {
        return [
            'description' => 'Documentation for the /api' . parent::title(). 'API endpoint.',
        ];
    }

    public function request()
    {
        return $this->info() . ': ' . $this->title();
    }

    public function title(): Field
    {
        return parent::title()->value('/api' . parent::title());
    }

}
