<?php

layout('article.md');

echo snippet('templates/reference/groups.md', [
    'groups'       => $kirby->collection('reference')->not('docs/reference/tools'),
    'headingLevel' => 2
]);

