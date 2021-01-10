<?php

use Kirby\Redirects\Redirects;

return [
    'route:after' => function ($route, $path, $method, $result, $final) {
            if ($final === true && empty($result) === true) {
                Redirects::go($path, $method);
            }
    }
];