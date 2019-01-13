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
        $children = array_map(function ($line) {
            return [
                'slug'     => Str::slug($line['Name']),
                'template' => 'hook',
                'model'    => 'hook',
                'num'      => 0,
                'content'  => [
                    'title' => $line['Name'],
                    'arguments' => implode(', ', Str::split($line['Arguments']))
                ]
            ];
        }, csv($this->root() . '/hooks.csv'));

        return Pages::factory($children, $this);
    }

}
