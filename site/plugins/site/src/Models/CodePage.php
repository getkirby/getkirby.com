<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class CodePage extends Page
{

    public function metadata(): array
    {
        return [
            'robots' => 'noindex, nofollow',
        ];
    }
}
