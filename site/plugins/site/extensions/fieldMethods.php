<?php

return [
    'toToc' => function ($field, string $headline = 'h2') {
        preg_match_all('!<' . $headline . '.*?>(.*?)</' . $headline . '>!s', $field->kt()->value(), $matches);

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
    'stripGlossary' => function ($field) {
        return $field->value(function ($value) {
            return str_replace('(glossary:', '(plain:', $value);
        });
    }
];
