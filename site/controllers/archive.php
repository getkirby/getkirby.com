<?php

return function ($kirby, $page) {

    $versions = [
        [
            'title' => 'Kirby 1',
            'mainVersion' => '1',
            'since' => '2012-2014',
            'description' => 'has reached its end of life and is no longer supported by us.',
            'link' => 'https://k1.getkirby.com',
            'repo' => 'https://github.com/getkirby-v1',
        ],
        [
            'title' => 'Kirby 2',
            'mainVersion' => '2',
            'since' => '2014-2020',
            'description' => 'has reached its end of life and is no longer supported by us.',
            'link' => 'https://k2.getkirby.com',
            'repo' => 'https://github.com/getkirby-v2',
        ],
        [
            'title' => 'Kirby 3.5',
            'mainVersion' => '3',
            'since' => 'Dec 2020 - Nov 2021',
            'description' => 'is not the most current version of Kirby and should not be used for new projects.',
            'link' => 'https://v35.getkirby.com',
            'repo' => 'https://github.com/getkirby',

        ],
        [
            'title' => 'Kirby 3.6',
            'mainVersion' => '3',
            'since' => 'Nov 2021 - June 2022',
            'description' => 'is not the most current version of Kirby and should not be used for new projects.',
            'link' => 'https://v36.getkirby.com',
            'repo' => 'https://github.com/getkirby',

        ],
        [
            'title' => 'Kirby 3.7',
            'mainVersion' => '3',
            'since' => 'June 2022 - Oct 2022',
            'description' => 'is not the most current version of Kirby and should not be used for new projects.',
            'link' => 'https://v37.getkirby.com',
            'repo' => 'https://github.com/getkirby',
        ],
        [
            'title' => 'Kirby ' . substr($kirby->version(), 0, 3),
            'mainVersion' => '3',
            'since' => 'Jan 2023',
            'description' => 'is the latest version of Kirby. <br><strong class="color-black">Start new projects with this version!',
            'link' => 'https://getkirby.com/docs',
            'repo' => 'https://github.com/getkirby',
        ]
    ];


    return [
        'versions' => $versions,
    ];

};
