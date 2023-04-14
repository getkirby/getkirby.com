<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceComponentPage extends ReflectionPage
{
    static protected array $components;

    protected function component(): Closure|null
    {
        static::$components ??= require $this->kirby()->root('kirby') . '/config/components.php';

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

    protected function reflection(): ReflectionFunction|null
    {
        if ($component = $this->component()) {
            return $this->reflection ??= new ReflectionFunction($component);
        }

        return null;
    }
}
