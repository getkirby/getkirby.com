<?php

return function ($page) {
    
    if ($advanced = get('advanced')) {
        Cookie::set('getkirby$advanced', $advanced, [
            'lifetime' => 60 * 24 * 365* 2
        ]);
    }
        
    return [
        'entries' => $page->children()->referenced()
    ];       
};
        