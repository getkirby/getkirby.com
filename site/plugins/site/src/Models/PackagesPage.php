<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Dir;
use Kirby\Toolkit\Str;

class PackagesPage extends Page
{

    public function children()
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $pages = [];

        foreach ($this->packages()->yaml() as $package) {

            $page = [
                'slug'     => Str::slug($package),
                'template' => 'package',
                'parent'   => $this,
                'num'      => 0
            ];

            $children = [];
            $dir      = $this->kirby()->root() . '/../kirby/src';
            $classes  = Dir::files($dir . '/' . $package);

            foreach ($classes as $class) {
                $class = basename($class, ".php");

                $children[] = [
                    'slug'     => Str::slug($class),
                    'model'    => 'class',
                    'template' => 'class',
                    'num'      => 0,
                    'content'  => [
                        'class' => 'Kirby\\' . $package . '\\' . $class
                    ]
                ];
            }

            $page['children'] = $children;
            $pages[] = $page;
        }

        return $this->children = Pages::factory($pages, $this);
    }

}
