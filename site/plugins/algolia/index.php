<?php

include __DIR__ . '/vendor/autoload.php';

/**
 * Helper function that returns a Kirby\Algolia instance
 *
 * @return Algolia
 */
function algolia()
{
    return Kirby\Algolia\Search::instance();
}
