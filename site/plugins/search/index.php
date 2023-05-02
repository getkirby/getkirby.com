<?php

use Kirby\Search\Search;

include __DIR__ . '/vendor/autoload.php';

/**
 * Helper function that returns a Kirby\Search\Index instance
 */
function algolia(): Search
{
	return Search::instance();
}
