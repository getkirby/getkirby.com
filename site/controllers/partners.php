<?php

return function ($kirby, $page) {
    $partners = $page->children()->listed()->shuffle();

    return [
        'plus'     => $partners->filterBy('isPlusPartner', true),
        'standard' => $partners->filterBy('isPlusPartner', false),
    ];
};
