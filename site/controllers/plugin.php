<?php

return function ($kirby, $page) {

  $repo     = $page->repository();
  $download = $repo;

  if (Str::contains($repo, 'github')) {
    $download = $repo . '/archive/master.zip';
  } else if (Str::contains($repo, 'bitbucket')) {
    $download = $repo . '/get/master.zip';
  } else if (Str::contains($repo, 'gitlab')) {
    $reponame = basename($repo);
    $download = $repo . '/-/archive/master/' . $reponame . '-master.zip';
  }

  return [
    'download'       => $download,
    'author'         => $page->parent(),
    'authorPlugins'  => $page->siblings(false),
    'relatedPlugins' => page('plugins')->grandChildren()->filterBy('category', $page->category()->value())->not($page)
  ];

};
