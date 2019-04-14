<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class CookbookPage extends Page
{

    public function recipes(string $category)
    {
        return $this->index()->filter(function ($recipe) use ($category) {
            return $recipe->parent()->slug() === $category ||
                   in_array($category, $recipe->secondary()->split(','));
        });
    }

}
