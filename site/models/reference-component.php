<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceComponentPage extends ReflectionPage
{

    static protected $components;

    protected function component()
    {
        if (static::$components === null) {
            static::$components = require $this->kirby()->root('kirby') . '/config/components.php';
        }

        return static::$components[$this->name()] ?? false;
    }

    public function exists(): bool
    {
        return $this->component() !== false;
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Core component'
            ]
        ]);
    }

    public function name(): string
    {
        return $this->content()->get('name')->or($this->slug());
    }

    public function onGitHub(string $path = ''): Field
    {
        return parent::onGitHub('config/components.php');
    }

    protected function _reflection()
    {
        if ($component = $this->component()) {
            return new ReflectionFunction($component);
        }
    }
}
