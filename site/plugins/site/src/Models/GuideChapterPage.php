<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class GuideChapterPage extends Page
{
    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'description' => strip_tags($this->excerpt()->kirbytags()),
        ];
    }

}
