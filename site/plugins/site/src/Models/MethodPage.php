<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
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

    public function inheritedFrom()
    {
        if ($parent = $this->reflection()->getDeclaringClass()) {
            $path = str_replace('Kirby\\', '', $parent->getName());
            $path = strtolower(str_replace('\\', '/', $path));

            $page = page('docs/reference/' . $path);

            if ($page && $page->is($this->parent()) === false) {
                return $page;
            }
        }

        return null;
    }

    public function isStatic(): bool
    {
        return $this->reflection()->isStatic() === true;
    }

    public function githubSource()
    {
        if ($reflection = $this->reflection()) {
            $file = $reflection->getFileName();
            $path = Str::from($file, 'src/');

            return option('github') . '/kirby/tree/develop/' . $path . '#L' . $this->line();
        }
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

    public function methodExists(): bool
    {
        return method_exists($this->className(), $this->methodName());
    }

    public function methodHidden(): bool
    {
        if ($this->docBlock() === false) {
            return false;
        }

        if (is_null($this->docBlock()->getTag('internal')) === false) {
            return true;
        }

        if (is_null($this->docBlock()->getTag('deprecated')) === false) {
            return true;
        }

        return false;
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
        if ($this->isStatic() === true) {
            $title = $this->parent()->classTitle() . '::' . $this->methodName() . '()';
        } else {
            $title = $this->parent()->title() . '->' . $this->methodName() . '()';
        }

        return parent::title()->value($title);
    }
}
