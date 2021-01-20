<?php

use Kirby\Cms\Field;

use Kirby\Reference\ReflectionPage;

class ReferenceComponentPage extends ReflectionPage
{

    protected $components;

    protected function component()
    {
        if ($this->components === null) {
            $this->components = require $this->kirby()->root('kirby') . '/config/components.php';
        }

        return $this->components[$this->name()] ?? false;
    }

    public function exists(): bool
    {
        return $this->component() !== false;
    }

    public function name(): string
    {
        return $this->content()->get('name')->or($this->slug());
    }

    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        return parent::onGithub('config/components.php');
    }

    /**
     * Helper method to create proper reflection
     */
    protected function _reflection()
    {
        return new ReflectionFunction($this->component());
    }
}
