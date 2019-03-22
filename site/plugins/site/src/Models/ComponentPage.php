<?php

namespace Kirby\Site\Models;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use ReflectionFunction;

class ComponentPage extends HelperPage
{

    protected $components;

    protected function component()
    {
        $this->components = $this->components ?? require $this->kirby()->root('kirby') . '/config/components.php';
        return $this->components[$this->methodName()] ?? false;
    }

    public function githubSource()
    {
        return option('github') . '/kirby/tree/' . App::version() . '/config/components.php#L' . $this->line();
    }

    public function methodExists(): bool
    {
        return $this->component() !== false;
    }

    public function methodName(): string
    {
        return $this->content()->get('methodName')->or($this->slug());
    }


    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->methodExists() === true) {
            return $this->reflection = new ReflectionFunction($this->component());
        }

        return $this->reflection = false;
    }

    public function title(): Field
    {
        return $this->content()->get('title');
    }

}
