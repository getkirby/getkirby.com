<?php

use Kirby\Cms\Field;
use Kirby\Reference\DocBlock;
use Kirby\Reference\SectionPage;
use Kirby\Reference\Types;
use Kirby\Toolkit\Properties;
use Kirby\Toolkit\Str;
use \ReferenceClassMethodPage as ReferenceClassMethod;

class ReferenceClassPage extends SectionPage
{

    protected static $aliases;

    protected $props = null;

    public function alias(): Field
    {
        static::$aliases = static::$aliases ?? require $this->kirby()->root('kirby') . '/config/aliases.php';

        $alias = array_search($this->name(), static::$aliases);
        $value = $alias !== false ? $alias : null;
        return new Field($this, 'alias', $value);
    }

    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children   = [];
        $pages      = parent::children();
        $reflection = $this->reflection();
        $methods    = $reflection->getMethods();

        foreach ($methods as $method)
        {
            // Don't include protected or private methods
            if ($method->isPublic() === false) {
                continue;
            }

            $slug = Str::kebab($method->getName());

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $isMagic = substr($slug, 0, 1) === '_';
            $num     = $isMagic ? null : 0;

            // Ensure that constructor method is listed,
            // while other magic methods remain unlisted
            if ($slug === '__construct') {
                $num = 0;

                // Automatially activate $props support for
                // constructur classmethod pages
                if ($parameter = $method->getParameters()[0]) {
                    if ($type = $parameter->getType()) {
                        if ($type->getName() === 'array') {
                            $content['properties'] = $content['properties'] ?? '$' . $parameter->getName();
                        }
                    }
                }
            }

            $children[] = [
                'slug'     => $slug,
                'model'    => 'reference-classmethod',
                'template' => 'reference-classmethod',
                'parent'   => $this,
                'content'  => $content,
                'num'      => $num
            ];
        }

        // Create the actual class methods as children pages collection
        $children = Pages::factory($children, $this)->filterBy('exists', true);

        // If the class is flagged as proxying another class,
        // get the proxied methods that are not covered by an
        // actual class method and add them
        if ($this->proxies()->isNotEmpty()) {
            foreach ($this->proxies()->yaml() as $proxy) {
                $proxied = ReferenceClassMethod::proxied($proxy, $children);
                $children = $children->add($proxied);
            }
        }

        // Return children pages collection sorted by slug,
        // but making sure `__construct` goes first
        return $this->children = $children->sortBy(
            'isMagic', 'desc',
            'slug', 'asc',
        SORT_NATURAL);
    }

    public function exists(): bool
    {
        return class_exists($this->name()) === true ||
               trait_exists($this->name()) === true;

    }

    public static function findByName(string $class): ?Page
    {
        $class = ltrim($class, '\\');
        $class = ReferenceClassAliasesPage::resolve($class);

        // don't even start to look if the class does not exist in Kirby
        if (class_exists($class) === false) {
            return null;
        }

        $objects = 'docs/reference/objects';
        $class   = explode('\\', $class);

        if (count($class) > 2) {
            $namespace = implode('//', array_slice($class, 1, -1));
            $class     = array_slice($class, -1)[0];
            $id        = Str::slug($namespace) . '/' .  Str::kebab($class);

            if ($page = page($objects . '/' . $id)) {
                if ($page->intendedTemplate()->name() === 'link') {
                    $page = page($page->link());
                }

                return $page;
            }
        }

        return null;
    }

    public function isStatic(): bool
    {
        return method_exists($this->name(), '__construct') === false;
    }

    public function isTrait(): bool
    {
        if ($reflection = $this->reflection()) {
            return $reflection->isTrait();
        }

        return false;
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Object',
                'title' => $this->name()
            ]
        ]);
    }

    public function name(bool $short = false): string
    {
        if ($short === true) {
            // prefer content field `name`
            if ($this->content()->has('name')) {
                return $this->content()->get('name')->value();
            }

            return $this->reflection()->getShortName();
        }

        // get class name as defined in content file
        return $this->class()->value();
    }

    public function properties(): array
    {
        if ($this->props !== null) {
            return $this->props;
        }

        $reflection = $this->reflection();


        if (!$reflection) {
            return $this->props = [];
        }

        $traits = [];
        $getTraits = function ($class) use(&$getTraits, &$traits) {
            if ($class->getParentClass() !== false) {
                $getTraits($class->getParentClass());
            }

            $traits = array_merge($traits, $class->getTraitNames());
        };
        $getTraits($reflection);

        if (in_array('Kirby\\Toolkit\\Properties', $traits) === false) {
            return $this->props = [];
        }

        $properties = array_filter($reflection->getProperties(), function ($prop) use ($reflection) {
            return $prop->getName() !== 'propertyData' &&
                   $prop->isStatic() === false &&
                   $reflection->hasMethod('set' . $prop->getName()) === true;
        });

        $data = [];

        foreach ($properties as $prop) {

            $name        = $prop->getName();
            $description = null;
            $type        = null;
            $required    = false;

            if ($method = $reflection->getMethod('set' . $name)) {
                $required  = $method->getNumberOfRequiredParameters() > 0;
                $parameter = $method->getParameters()[0];

                try {
                    $doc         = new DocBlock($method->getDocComment());
                    $description = (string)$doc->getSummary();
                } catch (Throwable $e) {
                    $doc = null;
                }

                if ($doc && $doc->getTag('internal')) {
                    continue;
                }

                if ($type = $parameter->getType()) {
                    $type = $type->getName();
                } elseif ($doc) {
                    $type = (string)$doc->getParameters()[0]->getType();
                }

                if ($parameter->isOptional()) {
                    $type = Str::rtrim($type, '|null');
                }
            }



            $type   = Types::factory($type ?? 'mixed', $this);
            $data[] = compact('name', 'required', 'type', 'description');
        }

        // remove line breaks from description
        $description = str_replace("\n", ' ', $description);

        // sort by the name of the prop
        array_multisort(array_column($data, 'name'), SORT_ASC, $data);

        return $this->props = $data;
    }

    public function onGitHub(string $path = ''): Field
    {
        $path = str_replace('Kirby\\', '', $this->name());
        $path = str_replace('\\', '/', $path);
        return parent::onGitHub('src/' . $path . '.php');
    }

    public function title(): Field
    {
        if ($this->content()->has('title')) {
            return parent::title();
        }

        $title = $this->name(true);
        return parent::title()->value($title);
    }

    protected function _reflection()
    {
        return new ReflectionClass($this->name());
    }

}
