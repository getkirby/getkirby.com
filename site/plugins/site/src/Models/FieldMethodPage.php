<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Data\Yaml;
use ReflectionFunction;
use ReflectionMethod;

class FieldMethodPage extends HelperPage
{

    protected $reflection;

    public function aliases()
    {
        return array_keys(Field::$aliases, $this->title()->value());
    }

    public function classNameShort(): string
    {
        return new Field($this, 'classNameShort', 'Field');
    }

    public function githubSource()
    {
        if(is_a($this->reflection(), 'ReflectionMethod')) {
            return option('github') . '/kirby/tree/master/src/Cms/Field.php#L' . $this->line();
        } else {
            return option('github') . '/kirby/tree/master/config/methods.php#L' . $this->line();

        }
    }

    public function line()
    {
        if ($reflection = $this->reflection()) {
            return $reflection->getStartLine();
        }

        return null;
    }

    public function methodCall(): string
    {
        $methodCall = parent::methodCall();
        $methodCall = '$field->' . $methodCall;

        return $methodCall;
    }

    public function methodExists(): bool
    {
        return isset(Field::$methods[$this->methodName()]) || method_exists(Field::class, $this->methodName());
    }

    /**
     * Remove the first parameter
     * as this is always the parent Field
     * and not useful for the docs
     *
     * @return array
     */
    public function parameters()
    {
        return array_slice(parent::parameters(), 1);
    }

    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if (isset(Field::$methods[$this->methodName()]) === true) {
            return $this->reflection = new ReflectionFunction(Field::$methods[$this->methodName()]);
        }

        if (method_exists(Field::class, $this->methodName()) === true) {
            return $this->reflection = new ReflectionMethod(Field::class, $this->methodName());
        }

        return $this->reflection = false;
    }

    protected function setReflection($reflection = null)
    {
        $this->reflection = $reflection;
        return $this;
    }

    public function title(): Field
    {
        return parent::title()->value('$field->' . $this->content()->get('title') . '()');
    }

}
