<?php

use Kirby\Cms\Url;
use Kirby\Cms\Html;
use Kirby\Cms\Page;

class VoicePage extends Page
{
    public function source()
    {
        $url = $this->content()->url()->value();

        if (empty($url)) {
            return '@' . $this->username();
        }

        return Url::short($url);
    }

    public function url($options = null): string
    {
        return $this->content()->url()->or('https://twitter.com/' . $this->username());
    }

    public function text() {

        $text = $this->content()->text();

        // match twitter usenames
        $text = preg_replace_callback('/(?<=^|[^\w])@([a-z0-9_]+)/i', function($matches) {
            return Html::a("https://twitter.com/{$matches[1]}", $matches[0]);
        }, $text);

        // match twitter hashtags
        $text = preg_replace_callback('/(?<=^|[^\w])#([a-z0-9_]+)/i', function($matches) {
            return Html::a("https://twitter.com/hashtag/{$matches[1]}", $matches[0]);
        }, $text);

        // escape '*'' characters, so they’re not interpreted by markdown
        $text = str_replace('*', '&#42;', $text);

        // use KirbyText to convert URLs to links
        return parent::text()->value($text)->kibytext();
    }

}
