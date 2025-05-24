<?php
/**
 * @var $page \Kirby\Cms\Page
 */
header('Content-Type: text/plain; charset=UTF-8');

echo '# ' . $page->title() . PHP_EOL . PHP_EOL;
if ($page->intro()->isNotEmpty()) {
	echo $page->intro()->value() . PHP_EOL . PHP_EOL;
} elseif ($page->description()->isNotEmpty()) {
	echo $page->description()->value() . PHP_EOL . PHP_EOL;
}

if ($page->text()->isNotEmpty()) {
	echo $page->text()->value() . PHP_EOL . PHP_EOL;
}
