<?php

echo markdownHeading($page->title()->unhtml(), 1);

if ($slots->intro() || $page->intro()->isNotEmpty()) {
    echo $slots->intro() ?? $page->intro()->convertToMarkdown();
    echo markdownHorizontalRule();
}

echo trim(snippet('templates/reference/entry/meta.md', return: true));
echo markdownBreak();

if ($page->screencast()->isNotEmpty()) {
    echo $page->screencast()->convertToMarkdown();
    echo markdownHorizontalRule();
}

if ($slot != '' || $page->text()->isNotEmpty()) {
    echo $slot != '' ? $slot : $page->text()->convertToMarkdown();
}

if ($page->resources()->toPages()->isNotEmpty()) {
    echo markdownHorizontalRule();
    echo markdownHeading('More information', 2);
    echo markdownLinkList($page->resources()->toPages());
}
