<?php

return function ($kirby, $page) {

    if ($advanced = get('advanced')) {
        $kirby->session()->set('getkirby$advanced', $advanced);
    }

    return [
        'entries' => $page->children()->referenced()
    ];
};
