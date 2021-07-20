<?php

namespace Kirby\Layout;

class Slots
{
    static public $render  = false;
    static public $slots   = [];
    static public $started = [];

    static public function render()
    {
        static::$render = true;
    }

    static public function start(?string $name = 'content')
    {
        ob_start();

        static::$started[] = $name ?? 'content';

        if (static::$render) {
            return;
        }

        static::$slots[$name] = [
            'name'    => $name,
            'content' => null,
        ];
    }

    static public function end()
    {
        $slotName = array_pop(static::$started);
        $content  = ob_get_contents();
        ob_end_clean();

        if (static::$render === true) {
            echo static::$slots[$slotName]['content'] ?? $content;
        } else {
            static::$slots[$slotName]['content'] = $content;
        }
    }
}
