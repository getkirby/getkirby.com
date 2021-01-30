<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\F;
use Kirby\Toolkit\Str;

class ReferenceHooksPage extends Page
{

    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }

    public function children()
    {
        $children = array_map(function ($hook) {

            $slug = Str::slug($hook['Name']);
            $page = $this->subpages()->find($slug);

            return [
                'slug'     => Str::slug($hook['Name']),
                'template' => 'hook',
                'model'    => 'hook',
                'num'      => 0,
                'content'  => [
                    'title'     => $hook['Name'],
                    'arguments' => implode(', ', Str::split($hook['Arguments'])),
                    'type'      => $hook['Type'],
                    'return'    => $hook['Return'],
                    'details'   => $page ? $page->details()->value() : null
                ]
            ];
        }, csv($this->root() . '/hooks.csv'));

        return Pages::factory($children, $this);
    }

    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'description' => strip_tags($this->excerpt()->kirbytags()),
        ];
    }

}
