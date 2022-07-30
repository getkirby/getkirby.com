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
    'incidents' => array_values($page->incidents()->toArray($idFilter)),
    'messages'  => array_values($page->messages()->toArray($idFilter))
];

// keep the data in the client cache for a day,
// but refresh the data in the CDN cache every half an hour;
// if getkirby.com is not reachable, continue to serve the data for two days
$kirby->response()->header('Cache-Control', 'max-age=86400, s-maxage=1800, stale-if-error=172800');

echo json($data);
