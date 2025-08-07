<?php

echo markdownHeading('Guide', 2);

foreach (collection('guides')->group('category') as $category => $items) {
    echo markdownHeading(option('categories')[$category] ?? ucfirst($category), 3);
    echo markdownLinkList($items);
}
