<?php

return [
    'shortUrl' => function ($field) {
        return $field->value(function ($value) {
            return Url::short(Url::base($value));
        });
    },
    'stripBreaks' => function ($field) {
        return $field->value(function ($value) {
            return preg_replace("$\r|\n$", ' ', $value);
        });
    },
    'stripGlossary' => function ($field) {
        return $field->value(function ($value) {
            return str_replace('(glossary:', '(plain:', $value);
        });
    },
    'toToc' => function ($field, string $headline = 'h2') {
        $value = $field->value();

        // Make sure not to include sceencast boxes
        $value = preg_replace('$\(screencast:.*\)$', '', $value);

        preg_match_all('!<' . $headline . '.*?>(.*?)</' . $headline . '>!s', $field->value($value)->kt()->value(), $matches);

        $headlines = new Collection;

        foreach ($matches[1] as $text) {
            $headline = new Obj([
                'id'   => '#' . Str::slug(Str::unhtml($text)),
                'text' => trim(strip_tags($text)),
            ]);

            $headlines->append($headline->id(), $headline);
        }

        return $headlines;
    },
];
