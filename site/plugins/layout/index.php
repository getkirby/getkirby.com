<?php

function layout($name = 'default', ?array $data = [])
{
	return Snippet::begin(
		file: kirby()->root('site') . '/layouts/' . $name . '.php',
		data: $data
	);
}
