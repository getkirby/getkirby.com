<?php

return [
	'command' => function ($cli) {

		$kirby = $cli->kirby();
		$kirby->impersonate('kirby');

		foreach (page('plugins')->grandChildren() as $plugin) {

			if ($plugin->versions()->isNotEmpty()) {
				continue;
			}

			$plugin->update([
				'versions' => '3'
			]);
		}

	}
];
