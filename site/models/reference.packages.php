<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Dir;
use Kirby\Toolkit\Str;

use Kirby\Reference\ReflectionSection;

class ReferencePackagesPage extends ReflectionSection
{
    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children = [];
        $root     = $this->kirby()->root('kirby') . '/src';

        foreach (Dir::dirs($root) as $package) {
            $package = ucfirst($package);

            $page = [
                'slug'     => Str::slug($package),
                'template' => 'link',
                'parent'   => $this,
                'num'      => 0,
                'content'  => [
                    'title' => 'Kirby\\' . $package,
                    'link'  => 'docs/reference/objects/@#' . Str::slug($package)
                ]
            ];

            $pages = [];

            foreach (Dir::files($root . '/' . $package) as $class) {
                $class = ucfirst(basename($class, '.php'));

                // see if class is a top-level priority object in Reference
                $priority = page('docs/reference/objects')
                                ->children()
                                ->listed()
                                 ->filterBy('class', 'Kirby\\' . $package . '\\' . $class)
                                 ->first();

                // also make sure to check the Tools section
                if ($priority === null) {
                    $priority = page('docs/reference/tools')
                                ->children()
                                ->listed()
                                ->filterBy('class', 'Kirby\\' . $package . '\\' . $class)
                                ->first();
                }

                // so create a redirect as child
                if ($priority) {
                    $pages[] = [
                        'slug'     => Str::slug($class),
                        'model'    => 'link',
                        'template' => 'link',
                        'num'      => 0,
                        'content'  => [
                            'title'   => $priority->name(true),
                            'excerpt' => $priority->excerpt(),
                            'link'    => $priority->id()
                        ]
                    ];

                // otherwise create virtual class page
                } else {
                    $pages[] = [
                        'slug'     => Str::slug($class),
                        'model'    => 'reference.class',
                        'template' => 'reference.class',
                        'num'      => 0,
                        'content'  => [
                            'class' => 'Kirby\\' . $package . '\\' . $class
                        ]
                    ];
                }
            }

            $page['children'] = $pages;
            $children[]       = $page;
        }

        return $this->children = Pages::factory($children, $this);
    }
}
