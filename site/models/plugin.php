<?php

use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Http\Remote;
use Kirby\Http\Url;
use Kirby\Toolkit\Obj;
use Kirby\Toolkit\Str;

class PluginPage extends Page
{

    protected $info;

    /**
     * Returns cache used for plugins
     *
     * @return \Kirby\Cache\Cache
     */
    public function cache()
    {
        return $this->kirby()->cache('plugins');
    }

    /**
     * Returns cache ID for specified section
     *
     * @param string $section
     * @return string
     */
    public function cacheId(string $section): string
    {
        return $this->id() . '/' . $section;
    }

    /**
     * Returns image used for card preview
     *
     * @return \Kirby\Cms\File|null
     */
    public function card(): ?File
    {
        return $this->images()->findBy('name', 'card');
    }

    /**
     * Returns the download link for the plugin
     * depending on the hoster
     *
     * @return string
     */
    public function download(): string
    {
        // prefer content file value
        if ($this->content()->has('download')) {
            return $this->content()->get('download')->value();
        }

        $url    = $this->repository()->value();
        $branch = $this->branch()->value() ?? 'master';

        if (Str::contains($url, 'github') === true) {
            return rtrim(Str::replace($url, 'github.com', 'api.github.com/repos'), '/') . '/zipball';
        }

        if (Str::contains($url, 'bitbucket') === true) {
            return $url . '/get/' . $branch . '.zip';
        }

        if (Str::contains($url, 'gitlab') === true) {
            $repo = basename($url);
            return $url . '/-/archive/' . $branch . '/' . $repo . '-' . $branch . '.zip';
        }

        return $url;
    }

    /**
     * Returns the icon name of the plugin's category
     *
     * @return string|null
     */
    public function icon(): ?string
    {
        return option('plugins.categories.' . $this->category() . '.icon');
    }

    /**
     * Returns image used as logo
     *
     * @return \Kirby\Cms\File|null
     */
    public function logo(): ?File
    {
        return $this->images()->findBy('name', 'logo');
    }

    /**
     * Metadata for opengraph
     *
     * @return array
     */
    public function metadata(): array
    {
        return [
            'thumbnail' => [
                'lead'  => 'Plugin',
                'image' => $this->screenshot()
            ]
        ];
    }

    /**
     * Returns preview code with fallback to
     * example code
     *
     * @return \Kirby\Cms\Field
     */
    public function preview(): Field
    {
        return parent::preview()->or($this->example());
    }

    /**
     * Returns image used for screenshot
     *
     * @return \Kirby\Cms\File|null
     */
    public function screenshot(): ?File
    {
        return $this->images()->findBy('name', 'screenshot');
    }

    public function toJson(bool $onlyIfCached = false)
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
            'version'     => $this->info($onlyIfCached)->version()
        ];

    }


    public function info(bool $onlyIfCached = false)
    {
        if ($this->info !== null) {
            return $this->info;
        }

        $repo = $this->repository();

        // only support GitHub hosted plugins
        if (Str::contains($repo, 'github') === false) {
            return new Obj();
        }

        $cacheId = $this->cacheId('info');
        $info    = $this->cache()->get($cacheId);


        // from cache
        if ($info !== null) {
            return $this->info = $info;
        }

        // prevent API calls
        if ($onlyIfCached === true) {
            return new Obj();
        }

        // call API
        $path    = Url::path((string)$repo);
        $headers = ['User-Agent' => 'Kirby'];
        $data    = [];

        if ($key = option('github.key')) {
            $headers['Authorization'] = 'token ' . $key;
        }


        // repository information
        $reponse = Remote::get(
            'https://api.github.com/repos/' . $path,
            compact('headers')
        );

        $json            = $reponse->json();
        $data['stars']   = $json['stargazers_count'] ?? false;
        $data['updated'] = $json['updated_at'] ?? false;

        // latest release information
        $reponse = Remote::get(
            'https://api.github.com/repos/' . $path . '/releases/latest',
            compact('headers')
        );

        $json            = $reponse->json();
        $data['updated'] = $json['published_at'] ?? $data['updated'];
        $data['version'] = $json['tag_name'] ?? false;

        // readme
        $readme = Remote::get(
            'https://api.github.com/repos/' . $path . '/readme',
            compact('headers')
        );

        $data['readme'] = base64_decode($readme->json()['content'] ?? '');

        // create info object
        $info = new Obj($data);

        // GitHub returns following HTTP response status codes:
        // 200: releases found
        // 404: no releases are found
        if ($reponse->code() === 200) {
            // caches for 3 hours if repository releases exists
            $this->cache()->set($cacheId, $info, 180);

            // remove plugins representation cache
            $this->kirby()->cache('pages')->remove('plugins.json');
        } else {
            // keeps the cache of a non-release repository longer (one day) for performance
            $this->cache()->set($cacheId, $info, 1440);
        }

        return $this->info = $info;
    }

}
