<?php

use Kirby\Cms\Field;
use Kirby\Reference\ReflectionPage;

class ReferenceHelperPage extends ReflectionPage
{

    public function exists(): bool
    {
        return function_exists($this->slug());
    }
    
    public static function findByName(string $name): ?ReferenceHelperPage
    {
        return page('docs/reference/templates/helpers')->find(Str::kebab($name));
    }
    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Helper'
            ]
        ]);
    }

    public function onGitHub(string $path = ''): Field
    {
        return parent::onGitHub('config/helpers.php');
    }

    public function title(): Field
    {
        return parent::title()->value($this->name() . '()');
    }

    protected function _reflection()
    {
        return new ReflectionFunction($this->slug());
    }
    
}
