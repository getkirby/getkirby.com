<?php

return [
    'markdown' => function (Kirby $kirby, string $text = null) {
        static $maki;

        $maki = $maki ?? new Kirby\Maki\Maki();

        return @$maki->text($text);
    }
];
