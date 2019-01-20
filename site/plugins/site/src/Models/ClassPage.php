<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Html;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Site\DocBlock;
use Kirby\Toolkit\Str;
use ReflectionClass;

class ClassPage extends Page
{

    protected $docBlock;
    protected $methodExists;
    protected $reflection;

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

        foreach ($methods as $method) {

            $slug = Str::kebab($method->getName());

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [
                    'undocumented' => true
                ];
            }

            $listed = $method->isPublic();
            $listed = substr($slug, 0, 1) === '_' ? false : $listed;

            $children[] = [
                'slug'     => $slug,
                'model'    => 'method',
                'template' => 'method',
                'parent'   => $this,
                'content'  => $content,
                'num'      => $listed ? 0 : null,
            ];
        }

        $pages = Pages::factory($children, $this)
                    ->filterBy('methodExists', true)
                    ->sortBy('slug');

        if (param('advanced') !== 'true') {
            $pages = $pages->filterBy('methodInternal', false)
                           ->filterBy('methodDeprecated', false);

        }

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
            $excerpt = trim($this->docBlock()->getSummary());
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

    public function githubDocs($action = 'tree'): string
    {
        return option('github') . '/getkirby.com/' . $action . '/develop/content/' . $this->diruri();
    }

    public function githubSource(): string
    {
        $path = str_replace('Kirby\\', '', $this->className());
        $path = str_replace('\\', '/', $path);

        return option('github') . '/kirby/tree/develop/src/' . $path . '.php';
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

    public function missingMethods()
    {
        $children = $this->children();
        $pages    = parent::children();

        foreach ($children as $child) {
            if ($page = $pages->find($child->slug())) {
                $pages = $pages->remove($page->id());
            }
        }

        return $pages;
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

    public function undocumentedMethods()
    {
        return $this->children()->filterBy('undocumented', true);
    }

}
