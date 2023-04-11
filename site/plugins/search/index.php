<?php

use Kirby\Search\Index;

include __DIR__ . '/vendor/autoload.php';

/**
 * Helper function that returns a Kirby\Search\Index instance
 */
function algolia(): Index
{
    return Kirby\Search\Index::instance();
}
