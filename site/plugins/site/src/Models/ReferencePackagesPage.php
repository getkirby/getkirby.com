<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Dir;
use Kirby\Toolkit\Str;

class ReferencePackagesPage extends Page
{

    public function children()
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $pages = parent::children()->toArray();

        foreach ($this->packages()->yaml() as $package) {

            $page = [
                'slug'     => Str::slug($package),
                'template' => 'link',
                'parent'   => $this,
                'num'      => null,
                'content'  => [
                    'title' => ucfirst($package),
                    'link' => 'docs/reference/@#' . Str::slug($package)
                ]
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
                    'num'      => null,
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
