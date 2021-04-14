<?php

use Kirby\Toolkit\V;

return function ($page) {
    $storyId    = get('your') ?? 'company';
    $story      = $page->find($storyId) ?? $page->find('company');
    $storyImage = $story->images()->findBy('name', 'panel');

    // shows banner only startDate/endDate is empty or current date is between in
    if (option('banner.enabled') === true) {
        foreach (option('banner.types', []) as $type) {
            if (
                (empty($type['startDate']) === true || V::date($type['startDate'], '<=', date('Y-m-d'))) &&
                (empty($type['endDate']) === true || V::date($type['endDate'], '>=', date('Y-m-d')))
            ) {
                $banner = $type;
                break;
            }
        }
    }

    return [
        'banner'     => $banner ?? null,
        'story'      => $story,
        'storyImage' => $storyImage
    ];
};
