<?php

use Kirby\Cms\App;

class Cachebuster {

    const ASSETS_FOLDER   = 'assets';
    const ENV_DEVELOPMENT = 'development';
    const ENV_PRODUCTION  = 'production';

    protected static function environment(string $env): bool
    {
        return @$_SERVER['HTTP_X_ENVIRONMENT'] === $env;
    }

    public static function url($path)
    {
        $kirby  = App::instance();

        if (static::environment(self::ENV_DEVELOPMENT) && strpos($path, self::ASSETS_FOLDER . '/') === 0) {
            $path = substr($path, strlen(self::ASSETS_FOLDER . '/'));
            $path = "assets/dev/{$path}";
        }

        $root = $kirby->roots()->index() . '/' . $path;

        if (file_exists($root)) {
            $path = $path . '?v=' . dechex(filemtime($root));
        }

        return Url::to($path);
    }

    public static function css($url, $attr = null)
    {
        if (is_array($url) === true) {
            $links = array_map(function ($url) use ($attr) {
                return static::css($url, $attr);
            }, $url);

            return implode(PHP_EOL, $links);
        }

        if ($url === '@auto') {
            $kirby = App::instance();
            $page  = $kirby->site()->page();
            $assetRoot = self::ASSETS_FOLDER . (static::environment(self::ENV_DEVELOPMENT) ? '/dev' : '') . '/css/templates/' . $page->template() . '.css';
            $assetSrc  = self::ASSETS_FOLDER . '/css/templates/' . $page->template() . '.css';
            if(file_exists($assetRoot)) {
                return static::css($assetSrc, $attr);
            }
        } else {
            $attr = is_array($attr) ? attr($attr, ' ') : attr(['media' => $attr], ' ');
            $tag  = '<link rel="stylesheet" href="%s"' . $attr . '>';
            return sprintf($tag, static::url($url));
        }
    }

    public static function js($src, $attr = false)
    {
        if (is_array($src) === true) {
            $scripts = array_map(function ($src) use ($attr) {
                return static::js($src, $attr);
            }, $src);

            return implode(PHP_EOL, $scripts);
        }

        if ($src === '@auto') {
            $kirby = App::instance();
            $page  = $kirby->site()->page();
            $assetRoot = self::ASSETS_FOLDER . (static::environment(self::ENV_DEVELOPMENT) ? '/dev' : '') . '/js/templates/' . $page->template() . '.js';
            $assetSrc  = self::ASSETS_FOLDER . '/js/templates/' . $page->template() . '.js';
            if (file_exists($assetRoot)) {
                return static::js($assetSrc, $attr);
            }
        } else {
            $tag = '<script src="%s"' . attr($attr, ' ') . '></script>';
            return sprintf($tag, static::url($src));
        }
    }

}

function cachebuster($path) {
    return cachebuster::url($path);
}
