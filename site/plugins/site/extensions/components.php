<?php

use Kirby\Cms\App;
use Kirby\Marsdown\Marsdown;

return [
    'markdown' => function (App $kirby, string $text = null, array $options = []) {
        static $parser;
        $parser = $parser ?? new Marsdown();

        if ($options['inline'] === true) {
            return @$parser->line($text);
        }

        return @$parser->text($text);
    },
];
