<?php

$data = [
    'latest'    => $kirby->version(),
    'supported' => [
        $supported->value() => 'actively supported',
        '2.5.13'            => 'security support until 31.12.2020'
        '1.*'                     => 'Not supported'
    ],
    'incidents' => array_values($incidents->toArray())
];

echo json_encode($data, JSON_UNESCAPED_SLASHES);
