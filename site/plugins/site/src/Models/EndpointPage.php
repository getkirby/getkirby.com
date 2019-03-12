<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Page;

class EndpointPage extends Page
{

    public function request()
    {
        return $this->info() . ': ' . $this->title();
    }

    public function title(): Field
    {
        return parent::title()->value('/api' . parent::title());
    }

}
