<?php

function layout($name = null, ?array $data = null)
{
    if (is_array($name) === true) {
        $data = $name;
        $name = null;
    }

    Kirby\Layout\Layout::start($name, $data);
}

function slot(?string $name = null)
{
    Kirby\Layout\Slots::start($name);
}

function endslot()
{
    echo Kirby\Layout\Slots::end();
}
