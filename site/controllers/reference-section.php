<?php

return function ($page) {
    
    if ($advanced = get('advanced')) {
        Cookie::set('getkirby$advanced', $advanced);
    }
        
    return [
        'entries' => $page->children()->referenced()
    ];       
};
        