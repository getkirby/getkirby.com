<?php

use Kirby\Cms\App;
use Kirby\Marsdown\Marsdown;

return [
    'markdown' => function (App $kirby, string $text = null, array $options = [], bool $inline = false) {
        static $parser;
        $parser = $parser ?? new Marsdown();

        if ($inline === true) {
            return @$parser->line($text);
        }

        return @$parser->text($text);
    },
];