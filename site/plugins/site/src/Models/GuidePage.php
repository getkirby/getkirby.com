<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class GuidePage extends Page
{
    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'description' => strip_tags($this->excerpt()->kirbytags()),
        ];
    }

}
