<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceHelperPage extends ReflectionPage
{

    public function exists(): bool
    {
        return function_exists($this->slug());
    }

    public function name(): string
    {
        return preg_replace_callback('!-([a-z])!', function ($matches) {
            return strtoupper($matches[1]);
        }, $this->slug());
    }

    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        return parent::onGithub('config/helpers.php');
    }

    /**
     * Overwrite template to `reference.method`
     */
    public function template()
    {
        return $this->kirby()->template('reference.method');
    }

    public function title(): Field
    {
        return parent::title()->value($this->name() . '()');
    }

    /**
     * Helper method to create proper reflection
     */
    protected function _reflection()
    {
        return new ReflectionFunction($this->slug());
    }
}
