<?php

$idFilter = function ($entry) {
    $entry = $entry->toArray();
    unset($entry['id']);

    return $entry;
};

$data = [
    'latest'    => $kirby->version(),
    'latestUrl' => 'https://github.com/getkirby/kirby/releases/tag/' . $kirby->version(),
    'supported' => array_values($page->supported()->toArray($idFilter)),
    'incidents' => array_values($page->incidents()->toArray($idFilter))
];

echo json($data);
