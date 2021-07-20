<?php

use Kirby\Cms\Field;
use Kirby\Toolkit\Str;
use Kirby\Reference\ReflectionPage;

class ReferenceFieldMethodPage extends ReflectionPage
{

    /**
     * Returns aliases for field method
     *
     * @return array
     */
    public function aliases(): array
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

    public static function findByName(string $name): ?ReferenceFieldMethodPage
    {
        return page('docs/reference/templates/field-methods')->find(Str::kebab($name));
    }

    public function metadata(): array
    {
        return array_replace_recursive(parent::metadata(), [
            'thumbnail' => [
                'lead'  => 'Reference / Field method'
            ]
        ]);
    }
    
    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGitHub(string $path = ''): Field
    {
        if (is_a($this->reflection(), 'ReflectionMethod') === true) {
            return parent::onGitHub('src/Cms/Field.php');
        }

        return parent::onGitHub('config/methods.php');
    }

    /**
     * Returns an array with all parameter info.
     * Omits the inserted `$field` parameter from refleciton info as 
     * it does not get passed on the call
     * 
     * @return array
     */
    public function parameters(): array
    {
        $parameters = parent::parameters();

        // Kirby automatically inserts $field as first parameter on all methods 
        // defined in `kirby/config/methods.php`. The reflection picks up this
        // parameter, however, we need to remove it from the list as it does not
        // actually get passed when calling the field method
        if (isset($parameters[0]) && $parameters[0]['name'] === '$field') {
            array_shift($parameters);
        }

        return $parameters;
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
     * Helper for reflection object
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
