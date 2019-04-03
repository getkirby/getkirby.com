<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;
use Kirby\Cms\Field;

class IssuePage extends Page
{
    public function description(): Field
    {
        return new Field($this, 'description', 'Read issue No. ' . $this->uid() . ' of our montly newsletter online. Originally published on '  . $this->date() . ' via email.');
    }
}
