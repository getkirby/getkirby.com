<?php
/**
 * @var Kirby\Cms\File|null $poster
 * @var string|null $text
 * @var string|null $title
 * @var string $url
 */

echo markdownHeading($title, 2);

if ($text) {
	echo $text . markdownBreak();
}

if ($poster) {
	echo markdownImage($poster->url());
	echo markdownBreak();
}

echo markdownLink('Watch the screencast', $url);
