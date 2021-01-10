<?php

return [
    [
        'pattern' => 'releases/(:num)\-(:num)',
        'action'  => function ($generation, $major) {
            return go('releases/' . $generation . '.' . $major);
        }
    ],
    [
        'pattern' => 'releases/(:num)\.(:num)',
        'action'  => function ($generation, $major) {
            return page('releases/' . $generation . '-' . $major);
        }
    ],
];
