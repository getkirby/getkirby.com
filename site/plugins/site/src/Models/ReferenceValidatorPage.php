<?php

namespace Kirby\Site\Models;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Toolkit\V;
use ReflectionFunction;

class ReferenceValidatorPage extends ReferenceHelperPage
{

    public function githubSource()
    {
        return option('github') . '/kirby/tree/' . App::version() . '/src/Toolkit/V.php#L' . $this->line();
    }

    public function methodCall(): string
    {
        $methodCall = parent::methodCall();
        $methodCall = 'V::' . $methodCall;

        return $methodCall;
    }

    public function methodExists(): bool
    {
        return isset(V::$validators[$this->methodName()]);
    }

    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->methodExists() === true) {
            return $this->reflection = new ReflectionFunction(V::$validators[$this->methodName()]);
        }

        return $this->reflection = false;
    }

    public function title(): Field
    {
        return new Field($this, 'title', 'V::' . $this->methodName() . '()');
    }

}
