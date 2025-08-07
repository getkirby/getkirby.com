<?php

layout('article.md');

$text = $page->entry()->convertToMarkdown();
$link = '';

if ($page->link()->isNotEmpty()) {
    if ($linkedPage = $page->link()->toPage()) {
        $link = markdownLink('Learn more', $linkedPage->markdownUrl());
    } else  {
        $link = markdownLink('Learn more', $page->link()->toUrl());
    }
}

echo cleanUpMarkdown(<<<MARKDOWN

$text

$link

MARKDOWN);
