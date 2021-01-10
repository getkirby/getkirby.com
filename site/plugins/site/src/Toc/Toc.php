<?php

namespace Kirby\Toc;

use Kirby\Cms\Field;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;
use Kirby\Toolkit\Str;

class Toc
{

    static public function headlines(Field $field, string $headline)
    {
        preg_match_all('!<' . $headline . '.*?>(.*?)</' . $headline . '>!s', $field->kt()->value(), $matches);

        $headlines = new Collection;

        foreach ($matches[1] as $text) {
            $headline = new Obj([
                'id'   => $id = '#' . Str::slug(Str::unhtml($text)),
                'url'  => $id,
                'text' => trim(strip_tags($text)),
            ]);

            $headlines->append($headline->url(), $headline);
        }

        return $headlines;
    }

    static public function anchors(Field $field, string $headlines)
    {
        $lastH2 = null;

        // add anchors to headlines
        $field->value = preg_replace_callback('!<(' . $headlines . ')>(.*?)</\\1>!s', function ($match) use (&$lastH2) {
            $id = Str::slug(Str::unhtml($match[2]));

            if ($match[1] === 'h3') {
                $id = $lastH2 . '__' . $id;
            } else {
                $lastH2 = $id;
            }

            return '<' . $match[1] . ' id="' . $id . '"><a href="#' . $id . '">' . $match[2] . '</a></' . $match[1] . '>';
        }, $field->value);

        return $field;
    }

}
