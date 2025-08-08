<?php

echo markdownHeading('Cookbook', 2);

foreach (collection('cookbook/categories') as $child) {
    echo markdownHeading($child->title()->unhtml(), 3);
    echo markdownLinkList($child->children()->listed());
}
