<?php

$data = [
    'latest'    => $kirby->version(),
    'latestUrl' => 'https://github.com/getkirby/kirby/releases/tag/' . $kirby->version(),
    'supported' => [
        $kirby->version()         => 'Latest Kirby release, actively supported',
        $supported->value() . '+' => 'No known security issues',
        '2.5.13+'                 => 'Security support until 31.12.2020, no active development',
        '1.*'                     => 'Not supported'
    ],
    'incidents' => array_values($incidents->toArray())
];

echo json_encode($data, JSON_UNESCAPED_SLASHES);
