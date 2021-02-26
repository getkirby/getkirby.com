<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class CookbookRecipePage extends Page
{

    public function categories()
    {
        $secondary = array_map(function ($category) {
            return $this->parent()->parent()->find($category);
        }, $this->secondary()->split(','));

        return array_merge([$this->parent()], $secondary);
    }

    public function isNew(): bool
    {
        return $this->published()->toDate('U') > (time() - 4500000);
    }

}
