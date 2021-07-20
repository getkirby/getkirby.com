<?php

namespace Kirby\Marsdown;

use Kirby\Toolkit\F;
use Kirby\Toolkit\Str;

class FileSystem
{
    /**
     * File System Icons
     */
    public static $types = [
        'readme'     => '/^(readme|license)\.?/i',
        'javascript' => ['js'],
        'css'        => ['css'],
        'html'       => ['html', 'htm', 'xhtml'],
        'font'       => ['woff', 'woff2', 'ttf', 'otf', 'eot'],
        'code'       => ['json'],
        'yaml'       => ['yaml'],
        'markdown'   => ['md', 'mdown', 'markdown'],
        'git'        => ['git', 'gitattributes', 'gitignore', 'gitmodules'],
        'php'        => ['php'],
        'yaml'       => ['yml'],
        'text'       => ['txt'],
    ];

    protected static function getIconByFilename($filename): ?string
    {
        if (in_array($filename, ['...', '…'])) {
            return null;
        }

        $extension = F::extension($filename);
        $icon      = F::type($filename);

        foreach (static::$types as $type => $extensions) {
            if (
                (
                    is_string($extensions) === true &&
                    preg_match($extensions, $filename)
                ) || (
                    is_array($extensions) === true &&
                    in_array($extension, $extensions)
                )
            ) {
                $icon = $type;
                break;
            }
        }

        return $icon ?? 'file';
    }

    public static function parse($text): string
    {
        return static::renderBlock(static::parseBlock($text));
    }

    // Source: http://stackoverflow.com/a/8882181
    protected static function parseBlock($text): array
    {

        $indentation = '  ';

        $result = [];
        $path   = [];

        foreach (explode("\n", $text) as $line) {
            // get depth and label
            $depth = 0;

            while (substr($line, 0, strlen($indentation)) === $indentation) {
                $depth += 1;
                $line = substr($line, strlen($indentation));
            }

            // truncate path if needed
            while ($depth < sizeof($path)) {
                array_pop($path);
            }

            // keep label (at depth)
            $path[$depth] = $line;

            // traverse path and add label to result
            $parent =& $result;

            foreach ($path as $depth => $key) {
                if (!isset($parent[$key])) {
                    $parent[$line] = array();
                    break;
                }

                $parent =& $parent[$key];
            }
        }

        // return
        return $result;
    }

    protected static function renderLabel(string $name, ?string $type = null): string
    {
        $html  = '<span role="presentation" class="filesystem-label" data-type="' . $type . '">';
        if ($type !== null) {
            $html .= icon($type);
        }
        $html .= $name;
        $html .= '</span>';

        return $html;
    }

    protected static function renderBlock($files, $level = 0): string
    {
        $html = '<ul>';

        foreach ($files as $filename => $children) {

            $hasChildren = count($children) > 0;
            $isFolder    = Str::endsWith($filename, '/');
            $icon        = static::getIconByFilename($filename);

            $html .= '<li>';

            if ($isFolder) {
                $filename = preg_replace('/\/$/', '', $filename);
                $icon     = $hasChildren ? 'folder-expanded' : 'folder-collapsed';

                if ($hasChildren) {
                    $html .= '<details open>';
                    $html .= '<summary>' . static::renderLabel($filename, $icon) . '</summary>';
                    $html .= static::renderBlock($children, $level + 1);
                    $html .= '</details>';
                    continue;
                }

            }

            $html .= static::renderLabel($filename, $icon);
            $html .= '</li>';

        }

        $html .= '</ul>';

        return $html;

    }

}

// ```filesystem
// content/
//   1-projects/
//     project-a/
//       .git
//       .gitattributes
//       archive.zip
//       css.css
//       file.unknown
//       font.eot
//       font.otf
//       font.ttf
//       font.woff
//       font.woff2
//       html.html
//       image-1.jpg
//       image-2.jpg
//       image-3.jpg
//       js.js
//       json.json
//       markdown.md
//       markdown.mdown
//       php.php
//       project-data.xls
//       project-info.pdf
//       project.txt
//       readme.md
//       LICENSE
//       some-audio.mp3
//       some-video.mp4
//       xml.xml
//       yaml.yml
//     project-b/
//       ...
//   2-about/
// ```
