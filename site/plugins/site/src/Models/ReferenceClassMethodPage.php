<?php

namespace Kirby\Site\Models;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Toolkit\Str;
use ReflectionMethod;

class ReferenceClassMethodPage extends ReferenceHelperPage
{

    public function alias()
    {
        if ($this->methodName() === '__construct') {
            return $this->parent()->alias();
        }

        return new Field($this, 'alias', null);
    }

    public function className(): string
    {
        return $this->parent()->className();
    }

    public function classNameShort(): string
    {
        return $this->parent()->classNameShort();
    }

    public function githubSource()
    {
        if ($reflection = $this->reflection()) {
            $file = $reflection->getFileName();
            $path = Str::from($file, 'src/');

            return option('github') . '/kirby/tree/' . App::version() . '/' . $path . '#L' . $this->line();
        }
    }

    public function inheritedFrom()
    {
        if ($parent = $this->reflection()->getDeclaringClass()) {
            if ($page = referenceLookup($parent->getName())) {
                if ($page && $page->is($this->parent()) === false) {
                    return $page;
                }
            }
        }

        return null;
    }

    public function isMagic(): bool
    {
        return substr($this->slug(), 0, 2) === '__';
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

        if ($this->methodName() === '__construct') {
            return 'new ' . $classTitle . Str::after($methodCall, $this->slug());
        } else if ($this->isStatic() === true) {
            return  $classTitle . '::' . $methodCall;
        } else {
            return '$' . strtolower($classTitle) . '->' . $methodCall;
        }
    }

    public function methodExists(): bool
    {
        return method_exists($this->className(), $this->methodName());
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

    public function title(): Field
    {
        if ($this->methodName() === '__construct') {
            $title = 'new ' . $this->parent()->classTitle() . '()';
        } else if ($this->isStatic() === true) {
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

        return parent::typeDefinition($type);
    }
}
