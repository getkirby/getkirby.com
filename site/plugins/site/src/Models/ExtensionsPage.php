<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class ExtensionsPage extends Page
{

    public function metadata(): array
    {
        return [
            'description' => strip_tags($this->excerpt()->kirbytags()),
            'twittercard' => 'summary',
        ];
    }
}
