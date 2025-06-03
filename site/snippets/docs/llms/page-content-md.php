<?php
/**
 * @var $page \Kirby\Cms\Page
 */
header('Content-Type: text/plain; charset=UTF-8');

use League\HTMLToMarkdown\HtmlConverter;
use League\HTMLToMarkdown\Converter\HeaderConverter;
use League\HTMLToMarkdown\Converter\TableConverter;

$converter = new HtmlConverter();
$converter->getConfig()->setOption('strip_tags', true);
$converter->getConfig()->setOption('hard_break', true);
$converter->getConfig()->setOption('header_style', HeaderConverter::STYLE_ATX);
$converter->getEnvironment()->addConverter(new HeaderConverter());
$converter->getEnvironment()->addConverter(new TableConverter());

echo '# ' . $page->title() . PHP_EOL . PHP_EOL;
if ($page->intro()->isNotEmpty()) {
	echo $converter->convert($page->intro()->kirbytext()) . PHP_EOL . PHP_EOL;
} elseif ($page->description()->isNotEmpty()) {
	echo $converter->convert($page->description()->kirbytext()) . PHP_EOL . PHP_EOL;
}

if ($page->text()->isNotEmpty()) {
	echo $markdown = $converter->convert($page->text()->kirbytext()) . PHP_EOL . PHP_EOL;
}
