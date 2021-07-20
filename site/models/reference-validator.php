<?php

use Kirby\Cms\Field;
use Kirby\Toolkit\V;
use Kirby\Reference\ReflectionPage;

class ReferenceValidatorPage extends ReflectionPage
{

    public function call(): string
    {
        return 'V::' . parent::call();
    }

    public function exists(): bool
    {
        return isset(V::$validators[$this->name()]);
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Validator'
            ]
        ]);
    }

    public function onGitHub(string $path = ''): Field
    {
        return parent::onGitHub('src/Toolkit/V.php');
    }

    protected function _reflection()
    {
        return new ReflectionFunction(V::$validators[$this->name()]);
    }

}
