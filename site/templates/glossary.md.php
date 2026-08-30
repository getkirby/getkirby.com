<?php
/**
 * @var DefaultPage $page
 */

layout('article.md');

echo markdownLinkList($page->children());
