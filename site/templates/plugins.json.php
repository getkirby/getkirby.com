<?php

$plugins = [];

foreach ($page->grandChildren()->sortBy('title', 'asc') as $plugin) {
	$plugins[] = $plugin->toJson(true);
}

echo json($plugins);
