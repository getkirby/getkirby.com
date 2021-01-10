<?php

use Kirby\Cms\Field;
use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;
use Kirby\Reference\ReflectionSection;

class ReferenceClassPage extends ReflectionSection
{

    protected $alias;

    /**
     * Returns potential class alias
     *
     * @return \Kirby\Cms\Field
     */
    public function alias(): Field
    {
        if ($this->alias !== null){
            return $this->alias;
        }

        $aliases = require $this->kirby()->root('kirby') . '/config/aliases.php';
        $alias   = array_search($this->name(), $aliases);
        $value   = $alias !== false ? $alias : null;
        return $this->alias = new Field($this, 'alias', $value);
    }

    /**
     * Create pages collection for class methods from reflection,
     * combining reflection info with content files
     *
     * @return \Kirby\Cms\Pages
     */
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
            // don't include protected or private methods
            if ($method->isPublic() === false) {
                continue;
            }

            $slug    = Str::kebab($method->getName());
            $isMagic = substr($slug, 0, 1) === '_';
            $num     = $isMagic ? null : 0;

            // ensure that constructor method is listed,
            // while other magic methods remain unlisted
            if ($slug === '__construct') {
                $num = 0;
            }

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $children[] = [
                'slug'     => $slug,
                'model'    => 'reference.classmethod',
                'template' => 'reference.classmethod',
                'parent'   => $this,
                'content'  => $content,
                'num'      => $num
            ];
        }

        return $this->children = Pages::factory($children, $this)
            ->filterBy('exists', true)
            ->sortBy('slug', 'asc', SORT_NATURAL);
    }

    /**
     * Checks if this exists as class or trait
     *
     * @return bool
     */
    public function exists(): bool
    {
        return class_exists($this->name()) === true ||
               trait_exists($this->name()) === true;

    }

    /**
     * Checks if the class is used excusively statically
     *
     * @return bool
     */
    public function isStatic(): bool
    {
        return method_exists($this->name(), '__construct') === false;
    }

    /**
     * Checks if this is a trait, not a class itself
     *
     * @return bool
     */
    public function isTrait(): bool
    {
        if ($reflection = $this->reflection()) {
            return $reflection->isTrait();
        }

        return false;
    }

    /**
     * Returns the full or short class name
     *
     * @param bool $short
     *
     * @return string
     */
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

    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        $path = str_replace('Kirby\\', '', $this->name());
        $path = str_replace('\\', '/', $path);
        return parent::onGithub('src/' . $path . '.php');
    }

    /**
     * Returns a title, giving priority to the content file
     * and falling back to the short class name
     *
     * @return \Kirby\Cms\Field
     */
    public function title(): Field
    {
        if ($this->content()->has('title')) {
            return parent::title();
        }

        $title = $this->name(true);
        return parent::title()->value($title);
    }

    /**
     * Helper method to create proper reflection
     */
    protected function _reflection()
    {
        return new ReflectionClass($this->name());
    }
}
