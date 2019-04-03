<?php

namespace Kirby\Meta;
// use Kirby\Toolkit\Obj;
use Kirby\Cms\Field;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\Html;

class PageMeta /*extends Obj*/ {

  protected $page;
  protected $data = [];

  public $defaults = [
    'robots' => true,
  ];

  public function __construct($page) {
    $this->page = $page;
  }

  public function getSetting(string $key)
  {
    $field = $this->page->content()->get($key);

    if ($field->exists()) {
        return $field;
    }

    if (isset($this->page::$meta) && isset($this->page::$meta[$key])) {
        return new Field($this->page, $key, $this->page::$meta[$key]);
    }

    $siteContent = site()->content();
    
    if ($siteContent->get($key)->exists()) {
        return $siteContent->get($key);
    }

    return new Field($this->page, $key, null);
  }

  public function getFile(string $key)
  {
    $field = $this->page->content()->get($key);

    if ($field->exists() && ($file = $field->toFile())) {
        return $file;
    }

    if (isset($this->page::$meta) && isset($this->page::$meta[$key])) {
        $value = $this->page::$meta[$key];
        if (is_callable($value)) {
            return $value::call($this->page);
        } else {
            return $this->page->file($value);
        }
    }

    return site()->content()->get($key)->toFile();
  }

  public function robots(): string
  {
        $html = [];

        $robots = $this->getSetting('robots');

        if ($robots->isNotEmpty()) {
            $html[] = Html::tag('meta', null, [
                'name' => 'robots',
                'content' => $robots->value(),
            ]);
        }

        $html[] = Html::tag('meta', null, [
            'name' => 'canonical',
            'content' => $this->page->url(),
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
    $opengraph['og:title'] = $this->page->title();
    $opengraph['og:type'] = 'website';

    // Meta and OpenGraph description
    $description = $this->getSetting('description');

    if ($description->isNotEmpty()) {
        $opengraph['og:description'] = $meta['description'] = $description->value();
    }

    // Image
    if ($thumbnail = $this->getFile('thumbnail')) {
        $opengraph['og:image'] = $thumbnail->url();
    }

    // Twitter settings
    $twitterSite = $this->getSetting('twittersite');
    if ($twitterSite->isNotEmpty()) {
        $meta['twitter:site'] = $twitterSite->value();
    }

    $twitterCreator = $this->getSetting('twittercreator');
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


  public function hasOwnDescription(): bool
  {
    return $this->page->description()->isNotEmpty();
  }

  public function description(): string
  {
    if ($this->hasOwnDescription() === true) {
      return $this->page->description()->value();
    }

    if ($this->page->text()->isNotEmpty()) {
      return Str::excerpt($this->page->text()->kirbytext()->value(), 160);
    }

    return site()->description()->value();
  }

  public function hasOwnThumbnail(): bool
  {
    return $this->page->thumbnail()->toFile() !== null;
  }

  public function thumbnail()
  {
    if ($image = $this->page->thumbnail()->toFile()) {
      return $image;
    }

    return site()->thumbnail()->toFile();
  }
}
