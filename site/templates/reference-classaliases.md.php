<?php
/**
 * @var ReferenceClassAliasesPage $page
 */

layout('reference.md');

snippet('kirbytext/reference.md', ['entries' => $page->children()]);
