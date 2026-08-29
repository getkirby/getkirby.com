<?php
/**
 * @var Kirby\Cms\App $kirby
 */

echo markdownHeading('Reference', 2);
echo snippet('templates/reference/groups.md', [
    'groups'       => $kirby->collection('reference')->not('docs/reference/tools'),
    'headingLevel' => 3
]);

