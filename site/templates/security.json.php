<?php

$idFilter = function ($entry) {
    $entry = $entry->toArray();
    unset($entry['id']);

    return $entry;
};

$data = [
    'latest'    => $kirby->version(),
    'latestUrl' => 'https://github.com/getkirby/kirby/releases/tag/' . $kirby->version(),
    'supported' => array_values($supported->toArray($idFilter)),
    'incidents' => array_values($incidents->toArray($idFilter))
];

echo json_encode($data, JSON_UNESCAPED_SLASHES);
