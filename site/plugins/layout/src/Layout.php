<?php

namespace Kirby\Layout;

use Kirby\Toolkit\Tpl;

class Layout
{
    static public $name = null;
    static public $data = null;

    static public function start(?string $name = null, ?array $data = null)
    {
        static::$name = $name ?? 'default';
        static::$data = $data ?? [];

        $kirby = kirby();
        $kirby->data = array_merge($kirby->data, Layout::$data);
    }

    static public function render(array $data = []): string
    {
        Slots::render();
        return Tpl::load(kirby()->root('site') . '/layouts/' . static::$name . '.php', $data);
    }
}
