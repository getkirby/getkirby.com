<?php

class PluginPage extends Page
{

  public function download()
  {
    $repo = $this->repository()->value();

    if (Str::contains($repo, 'github')) {
      return $repo . '/archive/master.zip';
    } else if (Str::contains($repo, 'bitbucket')) {
      return $repo . '/get/master.zip';
    } else if (Str::contains($repo, 'gitlab')) {
      $reponame = basename($repo);
      return '/-/archive/master/' . $reponame . '-master.zip';
    }

    return $repo;
  }

}
