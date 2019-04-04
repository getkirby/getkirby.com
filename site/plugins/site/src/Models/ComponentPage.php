<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class ComponentPage extends Page
{

    public function excerpt()
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
