<?php

use Kirby\Http\Response;

function pluginTemplate(string $file, array $data) {
  $contents = F::read($file);
  return Str::template($contents, $data);
}


return function ($page) {

  if (kirby()->request()->is('POST')) {

    $authorId   = Str::slug(get('author_id'));
    $pluginName = Str::slug(get('plugin_name'));

    $data = [
      'plugin' => [
        'name' => $pluginName,
        'id'   => $authorId . '/' . $pluginName,
      ],
      'description' => get('description'),
      'license' => get('license'),
      'author' => [
        'name'  => get('author_name'),
        'email' => get('author_email'),
      ]
    ];

    $root = $page->root() . '/_templates';

    $files = [
      '.editorconfig' => pluginTemplate($root . '/.editorconfig', $data),
      '.gitignore'    => pluginTemplate($root . '/.gitignore', $data),
      'composer.json' => pluginTemplate($root . '/composer.json', $data),
      'package.json'  => pluginTemplate($root . '/package.json', $data),
      'index.php'     => pluginTemplate($root . '/index.php', $data),
      'src/index.js'  => pluginTemplate($root . '/src/index.js', $data)
    ];

    $zip = new ZipArchive();
    $zipFile = $page->root() . '/_tmp/' . $data['plugin']['id'] . '-' . time() . '.zip';

    Dir::make(dirname($zipFile));

    if ($zip->open($zipFile, ZipArchive::CREATE) !== TRUE) {
      die("cannot open <$zipFile>");
    }

    foreach ($files as $filename => $file) {
      $zip->addFromString($filename, $file);
    }

    $zip->close();

    $response = Response::download($zipFile, $pluginName . '.zip');

    Dir::remove(dirname($zipFile));

    die($response);
  }

};
