<?php

echo markdownHeading('Cookbook', 1);

foreach (collection('cookbook/categories') as $child) {
    echo markdownHeading($child->title()->unhtml(), 2);
    echo markdownLinkList($child->children()->listed());
}
