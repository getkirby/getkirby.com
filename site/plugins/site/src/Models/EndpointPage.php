<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Page;

class EndpointPage extends Page
{

    public function guide()
    {
        if (parent::guide()->isEmpty()) {
            if ($this->parent()->guide()->isNotEmpty()) {
                return $this->parent()->guide();
            }
        }

        return parent::guide();
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
