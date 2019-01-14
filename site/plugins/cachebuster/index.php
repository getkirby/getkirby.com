<?php

use Kirby\Cms\App;

class Cachebuster
{

    const ASSETS_FOLDER   = 'assets';
    const ENV_DEVELOPMENT = 'development';
    const ENV_PRODUCTION  = 'production';

    protected static function environment(string $env): bool
    {
        return @$_SERVER['HTTP_X_ENVIRONMENT'] === $env;
    }

    public static function path($path)
    {
        $kirby  = App::instance();

        if (static::environment(static::ENV_DEVELOPMENT) && Str::contains($path, 'assets')) {
            $path = ltrim(substr($path, strlen(self::ASSETS_FOLDER . '/')), '/');
            $path = "assets/dev/{$path}";
        }

        $root = $kirby->roots()->index() . '/' . $path;

        if (file_exists($root)) {
            $path = $path . '?v=' . dechex(filemtime($root));
        }

        return $path;
    }

}
