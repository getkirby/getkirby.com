<?php

include __DIR__ . '/vendor/autoload.php';

/**
 * Helper function that returns a Kirby\Search\Index instance
 *
 * @return \Kirby\Search\Index
 */
function algolia()
{
    return Kirby\Search\Index::instance();
}
