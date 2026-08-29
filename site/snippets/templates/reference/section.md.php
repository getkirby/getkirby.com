<?php
/**
 * @var int $headingLevel
 * @var Kirby\Cms\Page $section
 */

echo markdownHeading($section->title(), $headingLevel ?? 3);
echo markdownLinkList($section->children());
