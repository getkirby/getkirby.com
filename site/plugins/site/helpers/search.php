<?php

/**
 * Helper function that returns a Kirby\Algolia instance
 *
 * @return Algolia
 */
function algolia()
{
    return Kirby\Algolia\Search::instance();
}
