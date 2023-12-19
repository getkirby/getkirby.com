<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title><?= xml($title ?? $page->title()) ?></title>
		<link><?= $link ?? $page->url() ?></link>
		<generator>Kirby</generator>
		<lastBuildDate><?= $modified ?></lastBuildDate>
		<atom:link href="<?= $url ?>" rel="self" type="application/rss+xml" />
		<?php if (!empty($description)): ?>
		<description><?= xml($description) ?></description>
		<?php endif ?>
