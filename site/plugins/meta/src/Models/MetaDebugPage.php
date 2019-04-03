<?php

namespace Kirby\Meta\Models;

use Kirby\Cms\Page;

class MetaDebugPage extends Page
{
    public static $meta = [
        'robots' => 'noindex, nofollow',
    ];
}