<?php

use Kirby\Data\Data;
use Kirby\Cms\File;
use Kirby\Cms\Nest;
use Kirby\Cache\FileCache;
use Kirby\Toolkit\Str;

class PluginPage extends Page
{

    public function cache()
    {
        return $this->kirby()->cache('plugins');
    }

    public function cacheId($section): string
    {
        return $this->id() . '/' . $section;
    }

    public function download()
    {
        $url   = $this->repository()->value();
        $branch = $this->branch()->value() ?? 'master';

        if (Str::contains($url, 'github')) {
            return Str::replace($url, 'github.com', 'api.github.com/repos') . '/zipball';
        }

        if (Str::contains($url, 'bitbucket')) {
            return $url . '/get/' . $branch . '.zip';
        }

        if (Str::contains($url, 'gitlab')) {
            $repo = basename($url);
            return $url . '/-/archive/' . $branch . '/' . $repo . '-' . $branch . '.zip';
        }

        return $url;
    }

    public function icon()
    {
        return option('plugins.categories.' . $this->category() . '.icon');
    }

    public function info()
    {
        $info = Data::read($this->file('composer.json')->root());

        return Nest::create($info, $this);
    }

    public function metadata(): array
    {
        return [
            'thumbnail' => [
                'lead'  => 'Plugin',
                'image' => $this->screenshot()
            ]
        ];
    }

    public function screenshot(): ?File
    {
        return $this->images()->findBy('name', 'screenshot');
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
                    'User-Agent'    => 'Kirby',
                    'Authorization' => 'token ' . getenv('GITHUB_ACCESS_TOKEN'),
                ]
            ]);

            $version = $response->json()['tag_name'] ?? false;

            // GitHub returns 404 if no releases are found
            // keeps the cache of a non-release repository longer (one day) for performance
            $this->cache()->set($cacheId, $version, $response->code() === 404 ? 1440 : 180);

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
