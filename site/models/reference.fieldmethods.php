<?php

use Kirby\Cms\Field;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;

use Kirby\Reference\ReflectionSection;

class ReferenceFieldMethodsPage extends ReflectionSection
{

    /**
     * Create pages collection for field methods from
     * dynamic and nativ methods,combining reflection
     * info with content files
     *
     * @return \Kirby\Cms\Pages
     */
    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children = [];
        $pages    = parent::children();
        $methods  = array_merge(
            $this->getDynamicMethods(),
            $this->getNativeMethods()
        );

        foreach ($methods as $method) {
            $slug = Str::kebab($method);

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $children[] = [
                'slug'       => $slug,
                'num'        => 0,
                'template'   => 'reference.fieldmethod',
                'model'      => 'reference.fieldmethod',
                'content'    => $content
            ];
        }

        return $this->children = Pages::factory($children, $this)
            ->sortBy('title', 'asc');
    }

    /**
     * Returns field methods from config file
     *
     * @return array
     */
    protected function getDynamicMethods(): array
    {
        $methods = (include $this->kirby()->root('kirby') . '/config/methods.php')($this->kirby());

        return array_keys($methods);
    }

    /**
     * Returns field methods from \Kirby\Cms\Field class
     *
     * @return array
     */
    protected function getNativeMethods(): array
    {
        $methods    = [];
        $reflection = new ReflectionClass(Field::class);
        $methods    = array_map(function ($method) {
            $name = $method->getName();

            if (substr($name, 0, 1) !== '_') {
                return $name;
            }
        }, $reflection->getMethods(ReflectionMethod::IS_PUBLIC));

        return array_filter($methods);
    }
}
