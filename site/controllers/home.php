<?php

return function ($page) {
    $storyId    = get('your') ?? 'company';
    $story      = $page->find($storyId) ?? $page->find('company');
    $storyImage = $story->images()->findBy('name', 'panel');

    return [
        'banner'     => currentBanner(),
        'story'      => $story,
        'storyImage' => $storyImage
    ];
};
