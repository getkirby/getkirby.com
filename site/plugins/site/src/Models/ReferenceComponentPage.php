<?php

namespace Kirby\Site\Models;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use ReflectionFunction;

class ReferenceComponentPage extends ReferenceHelperPage
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

    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'description' => 'Documentation for the <k-' . $this->slug() . '> Vue component.',
        ];
    }

}
