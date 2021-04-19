<?php

use Kirby\Toolkit\V;

return function ($page) {
    $storyId    = get('your') ?? 'company';
    $story      = $page->find($storyId) ?? $page->find('company');
    $storyImage = $story->images()->findBy('name', 'panel');

    return [
        'banner'     => banner(),
        'story'      => $story,
        'storyImage' => $storyImage
    ];
};
