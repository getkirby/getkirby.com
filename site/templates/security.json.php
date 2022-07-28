<?php

$idFilter = function ($entry) {
    $entry = $entry->toArray();
    unset($entry['id']);

    return $entry;
};

$data = [
    'latest'    => $kirby->version(),
    'versions'  => $page->versions()->toArray($idFilter),
    'urls'      => $page->urls()->toArray($idFilter),
    'incidents' => array_values($page->incidents()->toArray($idFilter))
];

echo json($data);
