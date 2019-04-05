<?php

namespace Kirby\Meta;
use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Toolkit\Html;

class PageMeta {

    protected $page;
    protected $metadata = [];

    public $defaults = [
    'robots' => true,
    ];

    public function __construct($page) {
        $this->page = $page;

        if (method_exists($this->page, 'metadata')) {
            $this->metadata = $this->page->metadata();
        }
    }

    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        
        $prefix = 'hasown';
        
        if (strpos($name, $prefix) === 0) {
            return $this->get(substr($name, strlen($prefix)), false)->isNotEmpty();    
        }
        
        return $this->get($name);
    }

    public function get(string $key, bool $fallback = true): Field
    {
        $key = strtolower($key);

        $field = $this->page->content()->get($key);

        if ($field->exists()) {
            return $field;
        }

        if (array_key_exists($key, $this->metadata) === true) {
            $value = $this->metadata[$key];
            if (is_callable($value) === true) {
                $result = $value->call($this->page);

                if (is_a($result, Kirby\Cms\Field::class)) {
                    return $result;
                }

                return new Field($this->page, $key, $result);
            }
            
            return new Field($this->page, $key, $value);
        }

        if ($fallback === true) {
            $siteContent = site()->content();

            if ($siteContent->get($key)->exists()) {
                return $siteContent->get($key);
            }
        }

        return new Field($this->page, $key, null);
    }

    public function getFile(string $key, bool $fallback = true): ?File
    {
        $key = strtolower($key);

        $field = $this->page->content()->get($key);

        if ($field->exists() && ($file = $field->toFile())) {
            return $file;
        }

        if (array_key_exists($key, $this->metadata) === true) {
            $value = $this->metadata[$key];
            if (is_callable($value) === true) {
                $value = $value->call($this->page);
            }
            
            if (is_a($value, File::class) === true) {
                return $value;
            }

            if (is_a($value, Field::class) === true) {
                return $value->toFile();
            }

            if (is_string($value) === true) {
                return $this->page->file($value);
            }
        }

        if ($fallback === true) {
            return site()->content()->get($key)->toFile();
        }
        
        return null;
    }

    public function hasOwnThumbnail(): bool
    {
        return $this->getFile('thumbnail', false) !== null;
    }

    public function opensearch(): string
    {
        return Html::tag('link', null, [
            'rel' => 'search',
            'type' => 'application/opensearchdescription+xml',
            'title' => site()->title(),
            'href' => url('open-search.xml'),
        ]) . PHP_EOL;
    }

    public function robots(): string
    {
        $html = [];

        $robots = $this->get('robots');

        if ($robots->isNotEmpty()) {
            $html[] = Html::tag('meta', null, [
                'name' => 'robots',
                'content' => $robots->value(),
            ]);
        }

        $html[] = Html::tag('link', null, [
            'rel' => 'canonical',
            'href' => $this->page->url(),
        ]);

        return implode(PHP_EOL, $html) . PHP_EOL;
    }

    public function social(): string
    {
        $html = [];
        $meta = [];
        $opengraph = [];
        $site = site();

        // Basic OpenGraph tags
        $opengraph['og:site_name'] = $site->title()->value();
        $opengraph['og:url'] = $this->page->url();
        $opengraph['og:type'] = 'website';


        $opengraph['og:title'] = $this->get('ogtitle')->or($this->page->title());

        // Meta and OpenGraph description
        $description = $this->get('description');

        if ($description->isNotEmpty()) {
            $opengraph['og:description'] = $description->excerpt(200);
            $meta['description'] = $description->excerpt(160);
        }

        $twitterCard = $this->get('twittercard');
        if ($twitterCard->isNotEmpty()) {
            $meta['twitter:card'] = $twitterCard->value();
        }

        // Image
        if ($thumbnail = $this->getFile('thumbnail')) {
            $opengraph['og:image'] = $thumbnail->url();

            if ($thumbnail->alt()->isNotEmpty()) {
                $opengraph['og:image:alt'] = $thumbnail->alt()->value();
            }
        } else {
            if ($meta['twitter:card'] === 'summary_large_image') {
                $meta['twitter:card'] = 'summary';
            }
        }

        // Twitter settings
        $twitterSite = $this->get('twittersite');
        if ($twitterSite->isNotEmpty()) {
            $meta['twitter:site'] = $twitterSite->value();
        }

        $twitterCreator = $this->get('twittercreator');
        if ($twitterCreator->isNotEmpty()) {
            $meta['twitter:creator'] = $twitterCreator->value();
        }

        // Generate Meta Tags
        foreach($meta as $name => $content):
            $html[] = Html::tag('meta', null, [
            'name'    => $name,
            'content' => $content,
            ]);
        endforeach;

        // Generate Opengraph Tags
        foreach($opengraph as $prop => $content):
            $html[] = Html::tag('meta', null, [
            'property' => $prop,
            'content'  => $content,
            ]);
        endforeach;

        return implode(PHP_EOL, $html) . PHP_EOL;
    }

    public function thumbnail(bool $fallback = true): ?File
    {
        return $this->getFile('thumbnail', $fallback);
    }

}
