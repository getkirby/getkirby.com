<?php

Kirby::plugin('getkirby/keycdn', [
    'components' => [
        'url' => function ($kirby, $path, $options, $original) {
            if (preg_match('!assets!', $path)) {
                if (option('keycdn', false) !== false) {
                    return option('keycdn.domain') . '/' . Cachebuster::path($path);
                } else {
                    return $original(Cachebuster::path($path), $options);
                }
            } else {
                return $original($path, $options);
            }
        }
    ]
]);
