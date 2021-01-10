<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceFieldmethodPage extends ReflectionPage
{

    /**
     * Returns aliases for field method
     *
     * @return void
     */
    public function aliases()
    {
        return array_keys(Field::$aliases, $this->name());
    }

    /**
     * Returns example how field method would be called
     *
     * @return string
     */
    public function call(): string
    {
        return '$field->' . parent::call();
    }

    /**
     * Checks if field method exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return isset(Field::$methods[strtolower($this->name())]) === true ||
               method_exists(Field::class, $this->name()) === true;
    }

    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        if (is_a($this->reflection(), 'ReflectionMethod') === true) {
            return parent::onGithub('src/Cms/Field.php');
        }

        return parent::onGithub('config/methods.php');
    }

    /**
     * Returns parameters for field method.
     * Remove the first parameteras this is always
     * the parent Field and not useful for the docs
     *
     * @return array
     */
    public function parameters(): array
    {
        return array_slice(parent::parameters(), 1);
    }

    /**
     * Overwrite template to `reference.method`
     */
    public function template()
    {
        return $this->kirby()->template('reference.method');
    }

    /**
     * Returns title based on field method call
     *
     * @return \Kirby\Cms\Field
     */
    public function title(): Field
    {
        return parent::title()->value('$field->' . $this->name() . '()');
    }

    /**
     * Helper method to create proper reflection
     */
    protected function _reflection()
    {
        $key = strtolower($this->name());
        if (isset(Field::$methods[$key]) === true) {
            return new ReflectionFunction(Field::$methods[$key]);
        }

        if (method_exists(Field::class, $this->name()) === true) {
            return new ReflectionMethod(Field::class, $this->name());
        }
    }
}
