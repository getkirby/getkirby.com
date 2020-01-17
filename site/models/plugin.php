<?php

use Kirby\Data\Data;
use Kirby\Cms\Nest;
use Kirby\Cache\FileCache;

class PluginPage extends Page
{

  public function cache()
  {
    return $this->kirby()->cache('plugins');
  }

  public function cacheId($section): string
  {
    return $this->slug() . '/' . $section;
  }

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

  public function info()
  {
    $info = Data::read($this->file('composer.json')->root());

    return Nest::create($info, $this);

  }

  public function version($onlyIfCached = false)
  {

    $repo = $this->repository();

    if (Str::contains($repo, 'github') === false) {
      return false;
    }

    $cacheId = $this->cacheId('version');
    $version = $this->cache()->get($cacheId);

    if ($version === null) {

      if ($onlyIfCached === true) {
        return false;
      }

      $path = Url::path((string)$repo);
      $response = Remote::get('https://api.github.com/repos/' . $path . '/releases/latest', [
        'headers' => [
          'User-Agent' => 'Kirby'
        ]
      ]);

      $version = $response->json()['tag_name'] ?? false;

      $this->cache()->set($cacheId, $version, 60);

    }

    return $version;

  }

  public function toJson($onlyIfCached = false)
  {

    $screenshot = $this->images()->findBy('name', 'screenshot');

    return [
      'title'  => $this->title()->value(),
      'url'    => $this->url(),
      'author' => [
        'name' => $this->parent()->title()->value(),
        'url'  => dirname($this->repository()),
      ],
      'repository'  => $this->repository()->value(),
      'download'    => $this->download(),
      'category'    => option('plugins.categories.' . $this->category() . '.label'),
      'description' => $this->description()->value(),
      'screenshot'  => $screenshot ? $screenshot->url() : null,
      'version'     => $this->version($onlyIfCached)
    ];

  }


}
