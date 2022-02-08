<?php

use Kirby\Data\Data;
use Kirby\Cms\File;
use Kirby\Cms\Nest;
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

    public function card()
    {
        $images = $this->images();
        return $images->findBy('name', 'card') ?? $images->findBy('name', 'screenshot') ?? $images->first();
    }

    public function download()
    {
        if ($this->content()->has('download')) {
            return $this->content()->get('download')->value();
        }

        $url   = $this->repository()->value();
        $branch = $this->branch()->value() ?? 'master';

        if (Str::contains($url, 'github')) {
            return rtrim(Str::replace($url, 'github.com', 'api.github.com/repos'), '/') . '/zipball';
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
                return null;
            }

            $path = Url::path((string)$repo);
            $headers = ['User-Agent' => 'Kirby'];
            if ($key = option('github.key')) {
                $headers['Authorization'] = 'token ' . $key;
            }

            $response = Remote::get('https://api.github.com/repos/' . $path . '/releases/latest', compact('headers'));

            $version = $response->json()['tag_name'] ?? false;

            // GitHub returns following HTTP response status codes:
            // 200: releases found
            // 404: no releases are found
            if ($response->code() === 200) {
                // caches for 3 hours if repository releases exists
                $this->cache()->set($cacheId, $version, 180);

                // remove plugins representation cache
                $this->kirby()->cache('pages')->remove('plugins.json');
            } else {
                // keeps the cache of a non-release repository longer (one day) for performance
                $this->cache()->set($cacheId, $version, 1440);
            }
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
