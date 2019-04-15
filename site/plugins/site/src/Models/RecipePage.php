<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class RecipePage extends Page
{

    public function categories()
    {
        $secondary = array_map(function ($category) {
            return $this->parent()->parent()->find($category);
        }, $this->secondary()->split(','));

        return array_merge([$this->parent()], $secondary);
    }

}
