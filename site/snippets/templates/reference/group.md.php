<?php

echo markdownHeading($group->title(), $headingLevel ??= 2);
echo snippet(
    name: [
        'templates/reference/sections/' . $group->slug() . '.md',
        'templates/reference/sections.md'
    ],
    data: [
        'headingLevel' => $headingLevel + 1,
        'sections'     => $group->children()
    ],
    return: true
);
