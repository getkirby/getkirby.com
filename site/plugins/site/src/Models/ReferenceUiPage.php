<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class ReferenceUiPage extends Page
{

    public function excerpt()
    {
        return parent::excerpt()->value(html('<k-' . $this->slug() . '>'));
    }

}
