<?php

$data = [
	'latest'    => $kirby->version(),
	'versions'  => $page->kirbyVersionsForUpdateCheck(),
	'urls'      => $page->urls(),
	'php'       => $page->php(),
	'incidents' => array_values($page->incidents()),
	'messages'  => array_values($page->messages())
];

// keep the data in the CDN & client cache for a day;
// if getkirby.com is not reachable, continue to serve the data for two days
$kirby->response()->header('Cache-Control', 'public, max-age=86400, stale-if-error=172800');

echo json($data);
