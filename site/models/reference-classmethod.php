<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;
use Kirby\Types\Type;

class ReferenceClassMethodPage extends ReflectionPage
{

    protected $inherited;

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

    public function class(bool $short = false): string
    {
        return $this->parent()->name($short);
    }

    public function exists(): bool
    {
        return method_exists($this->class(), $this->name());
    }

    public function inheritedFrom(): ?string
    {
        if ($this->inherited !== null) {
            return $this->inherited;
        }

        if ($parent = $this->reflection()->getDeclaringClass()) {
            if ($parent->getName() === $this->parent()->name()) {
                return null;
            }

            if ($page = ReferenceClassPage::findByName($parent->getName())) {
                return $this->inherited = $page->name();
            }

            return $this->inherited = $parent->getName();
        }

        return null;
    }

    /**
     * Checks if this is a magic method
     *
     * @return boolean
     */
    public function isMagic(): bool
    {
        return substr($this->slug(), 0, 2) === '__';
    }

    /**
     * Checks if this is static
     *
     * @return boolean
     */
    public function isStatic(): bool
    {
        if ($reflection = $this->reflection()) {
            return $reflection->isStatic() === true;
        }

        return false;
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Method'
            ]
        ]);
    }

    public function onGitHub(string $path = ''): Field
    {
        if ($reflection = $this->reflection()) {
            $file = $reflection->getFileName();
            $path = Str::from($file, 'src/');
            return parent::onGitHub($path);
        }
    }

    public function parameters(): array
    {
        if ($this->parameters !== null) {
            return $this->parameters;
        }

        $parameters = parent::parameters();

        foreach ($parameters as $key => $parameter) {
            $parameters[$key]['type'] = Type::factory($parameter['type'], $this);
        }

        return $this->parameters = $parameters;
    }

    public function title(): Field
    {
        $call = $this->call($this->name() . '()');
        return parent::title()->value($call);
    }

    protected function _reflection()
    {
        return new ReflectionMethod($this->parent()->name(), $this->name());
    }
    
}
