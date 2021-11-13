<?php

return function ($kirby, $page) {
    return [
        'entries' => $page->children()->listed()->filterBy('isDeprecated', false)
    ];
};
