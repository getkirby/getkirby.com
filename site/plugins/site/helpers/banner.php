<?php

use Kirby\Toolkit\Obj;

/**
 * Returns the currently active banner or
 * `null` if none is active
 * Sets the cache expiry appropriately
 *
 * @return \Kirby\Toolkit\Obj|null
 */
function currentBanner(): ?Obj {
    $banners = option('banners', []);

    // grab the first active configured banner
    // checked from top to bottom
    $banner = $minExpiry = null;
    foreach ($banners as $candidate) {
        // normalize the dates to timestamps
        if (is_string($candidate['startDate'] ?? null) === true) {
            $candidate['startDate'] = strtotime($candidate['startDate']);
        }

        if (is_string($candidate['endDate'] ?? null) === true) {
            // the end date is inclusive, add one day
            $candidate['endDate'] = strtotime($candidate['endDate']) + 86400;
        }

        $candidate = new Obj($candidate);

        // the cache will expire once the *first* of the configured
        // banners will start
        if (
            $candidate->startDate() &&
            ($minExpiry === null || $candidate->startDate() < $minExpiry)
        ) {
            $minExpiry = $candidate->startDate();
        }

        // check if the banner is currently active
        if (
            (!$candidate->startDate() || $candidate->startDate() <= time()) &&
            (!$candidate->endDate() || $candidate->endDate() >= time())
        ) {
            $banner = $candidate;
            break;
        }
    }

    // if a banner is currently active, the cache
    // will also expire when the active banner ends
    if ($banner !== null && $banner->endDate()) {
        $minExpiry = min($minExpiry, $banner->endDate());
    }

    kirby()->response()->cacheExpiry($minExpiry);

    return $banner;
}
