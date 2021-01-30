<?php

namespace Kirby\Site\Models;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Cms\Html;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Site\DocBlock;
use Kirby\Toolkit\Str;
use ReflectionClass;

class ReferenceClassPage extends Page
{

    protected $docBlock;
    protected $reflection;

    public function alias()
    {
        $aliases = require $this->kirby()->root('kirby') . '/config/aliases.php';
        $alias   = array_search($this->className(), $aliases);
        return new Field($this, 'alias', $alias !== false ? $alias : null);
    }

    public function children()
    {

        if ($this->children !== null) {
            return $this->children;
        }

        if (!$this->reflection()) {
            return $this->children = parent::children();
        }

        $methods  = $this->reflection()->getMethods();
        $pages    = parent::children();
        $children = [];

        foreach ($methods as $method)
        {
            if ($method->isPublic() === false) {
                continue;
            }

            $slug    = Str::kebab($method->getName());
            $isMagic = substr($slug, 0, 1) === '_';
            $num     = $isMagic ? null : 0;

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
                'model'    => 'method',
                'template' => 'method',
                'parent'   => $this,
                'content'  => $content,
                'num'      => $num
            ];
        }


        $pages = Pages::factory($children, $this)
                    ->filterBy('methodExists', true)
                    ->sortBy('slug');

        return $this->children = $pages;
    }

    public function classExists(): bool
    {
        return class_exists($this->className()) || trait_exists($this->className());

    }

    public function classNameShort(): string
    {
        return $this->reflection()->getShortName();
    }

    public function className(): string
    {
        return $this->class()->value();
    }

    public function classTitle(): string
    {
        return $this->content()->get('title')->or($this->classNameShort())->value();
    }

    public function docBlock()
    {
        if ($this->docBlock !== null) {
            return $this->docBlock;
        }

        if ($reflection = $this->reflection()) {
            return $this->docBlock = new DocBlock($reflection->getDocComment());
        }

        return $this->docBlock = false;
    }

    public function excerpt(): Field
    {

        $excerpt = null;

        if ($docBlock = $this->docBlock()) {
            $excerpt = trim($docBlock->getSummary());
            $excerpt = str_replace(PHP_EOL, ' ', $excerpt);

            if ($excerpt === '/') {
                $excerpt = null;
            }
        }

        if (empty($excerpt) === false) {
            return new Field($this, 'excerpt', $excerpt);
        }

        $fromContent = $this->content()->get('excerpt');

        if ($fromContent->isNotEmpty()) {
            return $fromContent;
        }

        return new Field($this, 'excerpt', null);
    }

    public function githubSource(): string
    {
        $path = str_replace('Kirby\\', '', $this->className());
        $path = str_replace('\\', '/', $path);

        return option('github') . '/kirby/tree/' . App::version() . '/src/' . $path . '.php';
    }

    public function isStatic()
    {
        return method_exists($this->className(), '__construct') === false;
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
        return [
            'description' => strip_tags($this->excerpt()->kirbytags()),
            'twittercard' => 'summary',
        ];
    }

    public function pathCrumb(): string
    {
        return $this->parent()->pathCrumb() . '<span>\\</span>' . Html::a($this->url(), $this->classNameShort(), ['class' => 'link-reset']);
    }

    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->classExists() === true) {
            return $this->reflection = new ReflectionClass($this->className());
        }

        return $this->reflection = false;
    }

    public function title(): Field
    {
        $title = $this->classTitle();

        if ($this->isStatic() === false) {
            $title = '$' . strtolower($title);
        }

        return parent::title()->value($title);
    }

    public function traits()
    {
        if ($reflection = $this->reflection()) {
            return $reflection->getTraits();
        }
    }
}
