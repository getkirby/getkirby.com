<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\F;
use SimpleXMLElement;

class ReferenceIconsPage extends Page
{
    public function metadata(): array
    {
        return [
            'description' => strip_tags($this->excerpt()->kirbytags()),
            'twittercard' => 'summary',
        ];
    }

    public function svg()
    {
        return F::read($this->kirby()->root('panel') . '/dist/img/icons.svg');
    }

    public function children()
    {
        $svg      = new SimpleXMLElement($this->svg());
        $children = [];

        foreach ($svg->defs->children() as $symbol) {
            $children[] = [
                'slug'     => str_replace('icon-', '', $symbol->attributes()->id),
                'template' => 'icon',
                'model'    => 'icon',
                'num'      => 0
            ];
        }

        return Pages::factory($children, $this)->sortBy('slug');

    }

}
