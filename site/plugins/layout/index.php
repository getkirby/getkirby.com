<?php

use Kirby\Cms\App;
use Kirby\Template\Snippet;

function layout(string $name = 'default', array|null $data = []): Snippet
{
	return Snippet::begin(
		file: App::instance()->root('site') . '/layouts/' . $name . '.php',
		data: $data
	);
}
