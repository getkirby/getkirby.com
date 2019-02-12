<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Html;
use Kirby\Toolkit\Str;
use ReflectionMethod;

class MethodPage extends HelperPage
{

    public function className(): string
    {
        return $this->parent()->className();
    }

    public function classNameShort(): string
    {
        return $this->parent()->classNameShort();
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

        return $this->content()->get('excerpt');
    }

    public function githubSource()
    {
        if ($reflection = $this->reflection()) {
            $file = $reflection->getFileName();
            $path = Str::from($file, 'src/');

            return option('github') . '/kirby/tree/master/' . $path . '#L' . $this->line();
        }
    }

    public function inheritedFrom()
    {
        if ($parent = $this->reflection()->getDeclaringClass()) {
            if ($page = $this->referenceLookup($parent->getName())) {
                if ($page && $page->is($this->parent()) === false) {
                    return $page;
                }
            }
        }

        return null;
    }

    public function isStatic(): bool
    {
        return $this->reflection()->isStatic() === true;
    }

    public function line(): int
    {
        if ($reflection = $this->reflection()) {
            return $reflection->getStartLine();
        }

        return null;
    }

    public function methodCall(): string
    {
        $methodCall = parent::methodCall();
        $classTitle = $this->parent()->classTitle();

        if ($this->isStatic() === true) {
            return  $classTitle . '::' . $methodCall;
        } else {
            return '$' . strtolower($classTitle) . '->' . $methodCall;
        }
    }

    public function methodDeprecated(): bool
    {
        if ($this->docBlock() === false) {
            return false;
        }

        return is_null($this->docBlock()->getTag('deprecated')) === false;
    }

    public function methodExists(): bool
    {
        return method_exists($this->className(), $this->methodName());
    }

    public function methodInternal(): bool
    {
        if ($this->docBlock() === false) {
            return false;
        }

        return is_null($this->docBlock()->getTag('internal')) === false;
    }

    public function methodScope()
    {

        $reflection = $this->reflection();

        if (!$reflection) {
            return null;
        }

        if ($reflection->isPublic()) {
            return 'public';
        }

        if ($reflection->isProtected()) {
            return 'protected';
        }

        if ($reflection->isPrivate()) {
            return 'private';
        }

    }

    public function parameters()
    {
        $parameters = parent::parameters();

        foreach ($parameters as $key => $parameter) {
            $parameters[$key]['type'] = $this->typeDefinition($parameter['type']);
        }

        return $parameters;
    }

    protected function referenceLookup($class)
    {
        $roots = [
            'docs/reference/objects',
            'docs/reference/@'
        ];

        foreach ($roots as $root) {
            $index = page($root)->index();
            if ($page = $index->filterBy('class', $class)->first()) {
                return $page;
            }
        }
    }

    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->methodExists() === true) {
            return $this->reflection = new ReflectionMethod($this->className(), $this->methodName());
        }

        return $this->reflection = false;
    }

    public function returnType()
    {
        return $this->typeDefinition(parent::returnType());
    }

    public function title(): Field
    {
        if ($this->isStatic() === true) {
            $title = $this->parent()->classTitle() . '::' . $this->methodName() . '()';
        } else {
            $title = $this->parent()->title() . '->' . $this->methodName() . '()';
        }

        return parent::title()->value($title);
    }

    protected function typeDefinition($type = null)
    {
        if ((string)$type === 'self') {
            $type = $this->parent()->class();
        }

        $class = str_replace('|null', '', $type);

        if ($reference = $this->referenceLookup($class)) {
            return Html::a($reference->url(), $type);
        }

        return $type;
    }
}
