<?php

// minimal site for `CrawlerTest::testCrawl()`
switch (rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
	case '/':
		header('Location: /docs', true, 302);
		break;
	case '/docs':
		echo '<img src="/docs/a b.png"><a href="/docs/warning">Warning</a>';
		break;
	case '/docs/warning':
		echo "<br />\n<b>Warning</b>:  Something went wrong";
		break;
	case '/docs/a b.png':
		header('Content-Type: image/png');
		echo 'image';
		break;
	default:
		http_response_code(404);
}
