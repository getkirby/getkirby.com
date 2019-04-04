<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\F;
use Kirby\Toolkit\Str;

class HooksPage extends Page
{

    public function children()
    {
        $children = array_map(function ($hook) {
            return [
                'slug'     => Str::slug($hook['Name']),
                'template' => 'hook',
                'model'    => 'hook',
                'num'      => 0,
                'content'  => [
                    'title' => $hook['Name'],
                    'arguments' => implode(', ', Str::split($hook['Arguments'])),
                    'type' => $hook['Type']
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
