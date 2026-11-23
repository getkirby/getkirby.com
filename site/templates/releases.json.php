<?php
/**
 * @var Kirby\Cms\App $kirby
 * @var ReleasesPage $page
 */

use Kirby\Toolkit\Str;

$versions = array_filter(
	$page->allTags(),
	fn ($release) => Str::contains($release, '-') === false
);

natsort($versions);

// keep the data in the CDN & client cache for a day;
// if getkirby.com is not reachable, continue to serve the data for two days
$kirby->response()->header('Cache-Control', 'public, max-age=86400, stale-if-error=172800');

echo json([
	'versions' => array_values($versions)
]);
