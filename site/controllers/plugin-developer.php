<?php

return function ($kirby, $page) {
    $categories = option('plugins.categories');

    return [
        'author' => $page,
        'authorPlugins' => $page->children(),
        'categories' => $categories,
        'currentCategory' => null
    ];
};
