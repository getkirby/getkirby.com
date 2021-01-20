<?php

use Kirby\Cms\Field;
use Kirby\Toolkit\V;

use Kirby\Reference\ReflectionPage;

class ReferenceValidatorPage extends ReflectionPage
{

    protected function _reflection()
    {
        return new ReflectionFunction(V::$validators[$this->name()]);
    }

    public function call(): string
    {
        return 'V::' . parent::call();
    }

    public function exists(): bool
    {
        return isset(V::$validators[$this->name()]);
    }

    public function onGithub(string $path = ''): Field
    {
        return parent::onGithub('src/Toolkit/V.php');
    }

}
