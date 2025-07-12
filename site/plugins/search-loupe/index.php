<?php

use Kirby\Search\Loupe\Search;

include __DIR__ . '/vendor/autoload.php';

/**
 * Helper function that returns a Kirby\Loupe\Search instance
 */
function loupe(): Search
{
    return Search::instance();
}
