<?php

$plugins = [];

foreach ($page->children() as $author) {

  foreach ($author->children() as $plugin) {

    $screenshot = $plugin->images()->findBy('name', 'screenshot');

    $plugins[] = [
      'title'  => $plugin->title()->value(),
      'url'    => $plugin->url(),
      'author' => [
        'name' => $author->title()->value(),
        'url'  => dirname($plugin->repository()),
      ],
      'repository'  => $plugin->repository()->value(),
      'download'    => $plugin->download(),
      'category'    => option('plugins.categories.' . $plugin->category() . '.label'),
      'description' => $plugin->description()->value(),
      'screenshot'  => $screenshot ? $screenshot->url() : null,
    ];
  }

}

echo json_encode($plugins, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

