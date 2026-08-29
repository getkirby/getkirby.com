<?php
/**
 * @var Kirby\Cms\Page $docs
 */

echo markdownHeading('Glossary', 2);
echo markdownLinkList($docs->children());
