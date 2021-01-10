<?php

use Kirby\Meta\PageMeta;

return [
    'meta' => function () {
        return new PageMeta($this);
    },
];
