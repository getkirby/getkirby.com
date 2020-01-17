<?php

$plugins = [];

foreach ($page->grandChildren() as $plugin) {
  $plugins[] = $plugin->toJson(true);
}

echo json_encode($plugins, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
