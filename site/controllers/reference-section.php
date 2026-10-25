<?php

return function ($page) {
    // static snapshot: always list all items,
    // no cookie-based "Most used" filter
    return [
        'entries' => $page->children()->listed()
    ];
};
        