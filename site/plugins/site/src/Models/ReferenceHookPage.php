<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class ReferenceHookPage extends Page
{

    public function excerpt()
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
            $example[] =  $tab . $tab . $tab . 'return ' . $this->content()->return() . ';';
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
            'twittercard' => 'summary',
            'description' => 'Reference page for the hook ' . $this->title(),
        ];
    }

}
