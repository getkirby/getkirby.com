<?php

use Kirby\Data\Data;
use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Cms\Nest;
use Kirby\Toolkit\Str;

class PluginPage extends Page
{
    protected $latestTag = null;

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
        return $this->images()->findBy('name', 'card');
    }

    public function changes($version = null)
    {
        if ($this->content()->has('changes')) {
            return $this->content()->get('changes')->value();
        }

        $url = $this->repository()->value();

        if (Str::contains($url, 'github')) {
            if ($version) {
                return $url . '/releases/tag/' . $this->tagPrefix() . $version;
            }

            return $url . '/releases/latest';
        }

        return $url;
    }

    public function download($version = null)
    {
        if ($this->content()->has('download')) {
            return $this->content()->get('download')->value();
        }

        $url    = $this->repository()->value();
        $object = $version ?? $this->branch()->value() ?? 'master';

        if (Str::contains($url, 'github')) {
            if ($version) {
                return $url . '/archive/refs/tags/' . $this->tagPrefix() . $version . '.zip';
            }

            return rtrim(Str::replace($url, 'github.com', 'api.github.com/repos'), '/') . '/zipball';
        }

        if (Str::contains($url, 'bitbucket')) {
            return $url . '/get/' . $object . '.zip';
        }

        if (Str::contains($url, 'gitlab')) {
            $repo = basename($url);
            return $url . '/-/archive/' . $object . '/' . $repo . '-' . $object . '.zip';
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

    public function logo()
    {
        return $this->images()->findBy('name', 'logo');
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

    public function preview(): Field
    {
        return parent::preview()->or($this->example());
    }

    public function screenshot(): ?File
    {
        return $this->images()->findBy('name', 'screenshot');
    }

    public function version(bool $onlyIfCached = false): string|null
    {
        if ($this->content()->version()->isNotEmpty()) {
            return $this->content()->version()->value();
        }

        if ($latestTag = $this->latestTag($onlyIfCached)) {
            // normalize the version number to be without leading `v`
            return ltrim($latestTag, 'vV');
        }

        return null;
    }

    public function toJson($onlyIfCached = false)
    {
        $screenshot = $this->images()->findBy('name', 'screenshot');

        $data = [
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
        ];

        // basic skeleton for the update check (can be extended later)
        if ($version = $this->version($onlyIfCached)) {
            $data += [
                'latest'   => $version,
                'versions' => [
                    $version => [
                        'description' => 'Latest release',
                        'status'      => 'latest'
                    ],
                    '*' => [
                        'description' => 'Actively supported',
                        'latest'      => $version,
                        'status'      => 'active-support'
                    ]
                ],
                'urls' => [
                    '*' => [
                        // `{{ version }}` is a template placeholder for
                        // the URL templates (so that the update check
                        // can insert any version into the URLs)
                        'changes'  => $this->changes('{{ version }}'),
                        'download' => $this->download('{{ version }}'),
                        'upgrade'  => $this->repository()->value(),
                    ]
                ],
                'incidents' => [],
                'messages'  => []
            ];
        }

        return $data;
    }

    protected function latestTag(bool $onlyIfCached = false): string|null
    {
        if ($this->latestTag !== null) {
            return $this->latestTag;
        }

        $repo = $this->repository();

        if (Str::contains($repo, 'github') === false) {
            return null;
        }

        $cacheId = $this->cacheId('latestTag');
        $latestTag = $this->cache()->get($cacheId);

        if ($latestTag === null) {

            if ($onlyIfCached === true) {
                return null;
            }

            $key = option('github.key');
            if ($key === null) {
                return null;
            }

            $path = Url::path((string)$repo);
            $headers = [
                'Authorization' => 'token ' . $key,
                'User-Agent' => 'Kirby'
            ];

            $response = Remote::get('https://api.github.com/repos/' . $path . '/releases/latest', compact('headers'));

            $latestTag = $response->json()['tag_name'] ?? false;

            // GitHub returns following HTTP response status codes:
            // 200: releases found
            // 404: no releases are found
            if ($response->code() === 200 && $latestTag) {
                // caches for 3 hours if repository releases exists
                $this->cache()->set($cacheId, $latestTag, 180);

                // remove plugins representation cache
                $this->kirby()->cache('pages')->remove('plugins.json');
            } else {
                // keeps the cache of a non-release repository longer (one day) for performance
                $this->cache()->set($cacheId, $latestTag, 1440);
            }
        }

        // normalize the return value
        // (`false` is only needed to differentiate
        // between non-existing cache data and errors)
        if ($latestTag === false) {
            return null;
        }

        return $this->latestTag = $latestTag;
    }

    public function license()
    {
        $license = $this->content()->get('license')->yaml();

        if (empty($license) === true) {
            return $license;
        }

        return new Obj($license);
    }

    protected function tagPrefix(): string
    {
        $latestTag = $this->latestTag(true);

        if (Str::startsWith($latestTag, 'v') === true) {
            return 'v';
        }

        return '';
    }
}
