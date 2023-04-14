<?php

use Kirby\Cms\App;
use Kirby\Template\Snippet;

function layout($name = 'default', ?array $data = [])
{
	return Snippet::begin(
		file: App::instance()->root('site') . '/layouts/' . $name . '.php',
		data: $data
	);
}
