<?php

use Kirby\Cms\Pages;
use Kirby\Cms\Template;
use Kirby\Data\Data;
use Kirby\Toolkit\Dir;
use Kirby\Toolkit\Str;
use Kirby\Reference\SectionPage;

class ReferenceClassesPage extends SectionPage
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

        // Add unlisted pages for all classes in namespace:
        // Loop through filesystem as proxy for namespace structure
        $root = $this->kirby()->root('kirby') . '/src';

        foreach (Dir::dirs($root) as $package) {
            // Add page and subpages for each namespace package
            $children[] = $this->namespace(
                $name = ucfirst($package), 
                $root . '/' . $package, 
            );

            // Add class page and method subpages for all nested namespaces
            // (only supports one level below main, e.g. `Kirb\Cms\Foo\Bar`)
            foreach (Dir::dirs($root . '/' . $package) as $subpackage) {
                $children[] = $this->namespace(
                    $name . '\\' . ucfirst($subpackage), 
                    $root . '/' . $package . '/' . $subpackage
                );
            }
        }

        // Add listed shortlink for all pages defined in the
        // content file in the `menu` field
        $quicklinks = ReferenceQuickLinkPage::childrenFromContentField($this->menu());
        array_push($children, ...$quicklinks);

        // Add shortlink to overview and
        // class alias page as listed children
        $children[] = [
            'slug'     => Str::random(3),
            'template' => 'separator',
            'num'      => 0
        ];
        $children[] = [
            'slug'     => 'all',
            'model'    => 'link',
            'template' => 'link',
            'num'      => 1,
            'content'  => [
                'title' => 'All classes',
                'link'  => '/docs/reference/objects'
            ]
        ];

        $children[] = [
            'slug'     => 'aliases',
            'model'    => 'reference-classaliases',
            'template' => 'reference-classaliases',
            'num'      => 2,
            'content'  => [
                'title' => 'Aliases',
                'intro' => 'In Kirby, classes are separated in different namespaces such as `Kirby\Cms\` or `Kirby\Http\`. Aliases help to access specific classes without the need to mention their namespace.'
            ]
        ];

        return $this->children = Pages::factory($children, $this);
    }

    /**
     * Returns page props for namespace
     * with classes as children and methods as grandchildren
     *
     * @param string $name
     * @param string $root
     * @return array
     */
    protected function namespace(string $name, string $root): array
    {
        return [
            'slug'     => $slug = Str::slug($name),
            'template' => 'link',
            'parent'   => $this,
            'num'      => null,
            'content'  => [
                'title' => 'Kirby\\' . $name,
                'link'  => 'docs/reference/objects#' . $slug
            ],
            'children' => $this->classes($name, $root)
        ];
    }

    /**
     * Creates an array of page properties for all class files in the
     * provided root, assigning them to a provided namespace
     *
     * @param string $namespace
     * @param string $root
     * @return array
     */
    protected function classes(string $namespace, string $root): array
    {
        $children = [];

        // Loop through each class PHP file and 
        // create as child page
        foreach (Dir::files($root) as $class) {
            $name  = ucfirst(basename($class, '.php'));
            $class = 'Kirby\\' . $namespace . '\\' . $name;
            $slug  = Str::kebab($name);
            $root  = $this->root() . '/' . Str::kebab($namespace) . '/0_' . $slug;

            try {
                $content = Data::read($root . '/reference-class.txt');
            } catch (Throwable $e) {
                $content = [];
            }
            
            $children[] = [
                'slug'     => $slug,
                'model'    => 'reference-class',
                'template' => 'reference-class',
                'num'      => 0,
                'root'     => $root,
                'content'  => array_merge($content, [
                    'class' => $class
                ])
            ];
        }

        return $children;
    }

    public function isActive(): bool
    {
        return false;
    }

    public static function isFeatured(string $page): bool
    {
        $objects = page('docs/reference/objects');
        $tools   = page('docs/reference/tools');
        $ids     = array_merge(
            $objects->menu()->yaml(), 
            $tools->menu()->yaml()
        );

        foreach ($ids as $id) {
            if (Str::endsWith($page, $id)) {
                return true;
            }
        }

        return false;
    }
}
