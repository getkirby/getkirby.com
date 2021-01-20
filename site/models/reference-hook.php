<?php

use Kirby\Cms\Field;

use Kirby\Reference\ReflectionPage;

class ReferenceHookPage extends ReflectionPage
{
    public function excerpt(): Field
    {
        return $this->arguments();
    }

    public function example()
    {
        $tab  = '    ';
        $args = $this->arguments();

        $example[] = '```php "/site/config/config.php"';
        $example[] = 'return [';
        $example[] = $tab . "'hooks' => [";
        $example[] = $tab . $tab . "'" . $this->title() . "' => function ($args) {";
        $example[] = $tab . $tab . $tab . '// your code goes here';

        if ($this->type() == 'apply') {
        $example[] =  $tab . $tab . $tab . 'return ' . $args . ';';
        }

        $example[] = $tab . $tab . '}';
        $example[] = $tab . ']';
        $example[] = ']';
        $example[] = '```';

        return parent::example()->value(implode(PHP_EOL, $example));
    }

    public function metadata(): array
    {
        return [
            'description' => 'Reference page for the hook ' . $this->title(),
            'twittercard' => 'summary',
        ];
    }
}
