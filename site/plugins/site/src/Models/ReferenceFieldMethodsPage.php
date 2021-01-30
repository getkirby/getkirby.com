<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Cms\Field;
use Kirby\Toolkit\Str;
use ReflectionClass;
use ReflectionFunction;
use ReflectionMethod;

class ReferenceFieldMethodsPage extends Page
{

    public function subpages()
    {
        return Pages::factory($this->inventory()['children'], $this);
    }

    public function children()
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $methods  = array_merge($this->getDynamicMethods(), $this->getNativeMethods());
        $children = [];
        $subpages = $this->subpages();

        foreach ($methods as $name => $reflection) {

            $slug = Str::kebab($name);
            $page = $subpages->find($slug);

            $children[] = [
                'slug'       => $slug,
                'num'        => 0,
                'template'   => 'field-method',
                'model'      => 'field-method',
                'reflection' => $reflection,
                'content'    => [
                    'title'   => $name,
                    'excerpt' => $page ? $page->excerpt()->value() : null,
                    'text'    => $page ? $page->text()->value() : null
                ]
            ];
        }

        return $this->children = Pages::factory($children, $this)->sortBy('title', 'asc');
    }

    protected function getDynamicMethods()
    {
        $methods = (include $this->kirby()->root('kirby') . '/config/methods.php')($this->kirby());

        foreach ($methods as $key => $function) {
            $methods[$key] = new ReflectionFunction($function);
        }

        return $methods;
    }

    protected function getNativeMethods()
    {
        $methods    = [];
        $reflection = new ReflectionClass(Field::class);

        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $name = $method->getName();

            if (substr($name, 0, 1) !== '_') {
                $methods[$name] = $method;
            }
        }

        return $methods;
    }

}
