<?php

use Kirby\Cms\Page;

class ReferencePage extends Page
{

    /**
     * Whether to show 2nd sidebar in Reference to select items
     * and navigate easily between siblings
     *
     * @return bool
     */
    public function hasSelector(): bool
    {
        return false;
    }

}
