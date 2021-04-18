<?php

use Kirby\Cms\Pages;
use Kirby\Cms\Template;
use Kirby\Toolkit\Dir;
use Kirby\Toolkit\Str;
use Kirby\Reference\SectionPage;

class ReferencePackagesPage extends SectionPage
{

    /**
     * Creates children collection by parsing the `src/` folder of
     * the Kirby core
     *
     * @return Pages
     */
    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children = [];
        $root     = $this->kirby()->root('kirby') . '/src';

        foreach (Dir::dirs($root) as $package) {
            // Package
            $children[] = static::package(
                ucfirst($package), 
                $root . '/' . $package, 
                $this
            );

            // Subpackages
            foreach (Dir::dirs($root . '/' . $package) as $subpackage) {
                $children[] = static::package(
                    ucfirst($package) . '\\' . ucfirst($subpackage), 
                    $root . '/' . $package . '/' . $subpackage, 
                    $this
                );
            }
        }

        return $this->children = Pages::factory($children, $this);
    }

    /**
     * Creates an array of page properties for all class files in the
     * provided root, assigning them to a provided namespace
     *
     * @param string $root
     * @param string $namespace
     * @return array
     */
    protected static function classes(string $root, string $namespace): array
    {
        $pages = [];

        foreach (Dir::files($root) as $class) {
            $name      = ucfirst(basename($class, '.php'));
            $class     = 'Kirby\\' . $namespace . '\\' . $name;
            $reference = page('docs/reference');
            
            // See if class is a top-level priority object in Reference
            $objects  = $reference->find('objects')->children()->listed();
            $priority = $objects->filterBy('class', $class)->first();

            // Also make sure to check the Tools section
            if ($priority === null) {
                $tools    = $reference->find('tools')->children()->listed();
                $priority = $tools->filterBy('class', $class)->first();
            }

            // If we already have it in the Reference, create a link
            if ($priority) {
                $pages[] = [
                    'slug'     => Str::slug($name),
                    'model'    => 'link',
                    'template' => 'link',
                    'num'      => 0,
                    'content'  => [
                        'title' => $priority->reflection()->getShortName(),
                        'intro' => $priority->intro(),
                        'link'  => $priority->id()
                    ]
                ];

            // Otherwise create virtual class page
            } else {
                $pages[] = [
                    'slug'     => Str::slug($name),
                    'model'    => 'reference-class',
                    'template' => 'reference-class',
                    'num'      => 0,
                    'content'  => [
                        'class' => $class
                    ]
                ];
            }
        }

        return $pages;
    }

    /**
     * Return package props with classes as children collection
     *
     * @param string $name
     * @param string $root
     * @param static $parent
     * @return array
     */
    protected static function package(string $name, string $root, $parent): array
    {
        return [
            'slug'     => $slug = Str::slug($name),
            'template' => 'link',
            'parent'   => $parent,
            'num'      => 0,
            'content'  => [
                'title' => 'Kirby\\' . $name,
                'link'  => 'docs/reference/@/classes#' . $slug
            ],
            'children' => static::classes($root, $name)
        ];
    }

}
