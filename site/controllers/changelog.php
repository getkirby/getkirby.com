<?php

return function ($page) {

    $releases = page('releases')
        ->children()
        ->flip()
        ->filter(fn ($release) => $release->breaking()->isNotEmpty()
        );

    return [
        'releases' => $releases,
    ];

};