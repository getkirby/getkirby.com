<?php

use Kirby\Reference\SectionPage;
use Kirby\Toolkit\Str;

class ReferenceClassAliasesPage extends SectionPage
{

    protected static $aliases = null;

    protected static function aliases(): array
    {
        if (static::$aliases !== null) {
            return static::$aliases;
        }

        return static::$aliases = require kirby()->root('kirby') . '/config/aliases.php';
    }

    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $aliases  = $this->aliases();
        $children = [];

        ksort($aliases);

        foreach ($aliases as $alias => $class) {

            $parts = explode('\\', $alias);

            if (
                count($parts) < 2 &&
                $page = ReferenceClassPage::findByName($class)
            ) {
                $children[] = [
                    'slug'     => Str::kebab($alias),
                    'model'    => 'link',
                    'template' => 'link',
                    'parent'   => $this,
                    'num'      => 0,
                    'content'  => [
                        'title' => ucfirst($alias),
                        'intro' => '&rarr; ' . $class,
                        'link'  => $page->id()
                    ],
                ];
            }
        }

        return $this->children = Pages::factory($children, $this);
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Class'
            ]
        ]);
    }

    public static function resolve(string $name): string
    {
        $aliases  = static::aliases();
        return $aliases[Str::lower($name)] ?? $name;

    }

}
