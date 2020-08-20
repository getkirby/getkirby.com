<?php

use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Toolkit\Str;
use Kirby\Reference\ReflectionPage;

class ReferenceClassmethodPage extends ReflectionPage
{

    protected $inherited;
    protected $parameters;

    /**
     * Returns example how method would be called
     *
     * @param string $call
     *
     * @return string
     */
    public function call(string $call = null): string
    {
        if ($call === null) {
            $call = parent::call();
        }

        $class = $this->class(true);

        if ($this->name() === '__construct') {
            return 'new ' . $class . Str::after($call, $this->slug());
        }

        if ($this->isStatic() === true) {
            return  $class . '::' . $call;
        }

        return '$' . strtolower($class) . '->' . $call;
    }

    /**
     * Returns parent class name
     *
     * @param bool $short
     *
     * @return string
     */
    public function class(bool $short = false): string
    {
        return $this->parent()->name($short);
    }

    /**
     * Checks if the class method exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return method_exists($this->class(), $this->name());
    }

    /**
     * Return Reference class page if the methods was inherited
     * from this parent class
     *
     * @return \Kirby\Cms\Page|null
     */
    public function inheritedFrom(): ?Page
    {
        if ($this->inherited !== null) {
            return $this->inherited;
        }

        if ($parent = $this->reflection()->getDeclaringClass()) {
            if ($page = lookup($parent->getName())) {
                if ($page && $page->is($this->parent()) === false) {
                    return $this->inherited = $page;
                }
            }
        }

        return null;
    }

    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        if ($reflection = $this->reflection()) {
            $file = $reflection->getFileName();
            $path = Str::from($file, 'src/');
            return parent::onGithub($path);
        }
    }

    /**
     * Returns array of method's parameters
     *
     * @return array
     */
    public function parameters(): array
    {
        if ($this->parameters !== null) {
            return $this->parameters;
        }

        $parameters = parent::parameters();

        foreach ($parameters as $key => $parameter) {
            $parameters[$key]['type'] = types($parameter['type'], $this);
        }

        return $this->parameters = $parameters;
    }

    /**
     * Overwrite template to `reference.method`
     */
    public function template()
    {
        return $this->kirby()->template('reference.method');
    }

    /**
     * Returns title based on method call
     *
     * @return \Kirby\Cms\Field
     */
    public function title(): Field
    {
        $call = $this->call($this->name() . '()');
        return parent::title()->value($call);
    }

    /**
     * Helper method to create proper reflection
     */
    protected function _reflection()
    {
        return new ReflectionMethod($this->parent()->name(), $this->name());
    }
}
