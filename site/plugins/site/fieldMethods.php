<?php

return [

    'anchorHeadlines' => function ($field, $headlines = 'h2|h3') {

        $headlinesPattern = is_array($headlines) ? implode('|', $headlines) : $headlines;

        // add anchors to headlines
        $field->value = preg_replace_callback('!<(' . $headlinesPattern . ')>(.*?)</\\1>!s', function ($match) {
            $id = Str::slug(Str::unhtml($match[2]));
            return '<' . $match[1] . ' id="' . $id . '"><a href="#' . $id . '">' . $match[2] . '</a></' . $match[1] . '>';
        }, $field->value);

        return $field;
    },

    'future' => function ($field) {
        return version_compare(Kirby::version(), $field->value, '<');
    },

    'headlines' => function($field, $headline = 'h2') {

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

    },

    'replace' => function ($field, $replace) {
        $field->value = Str::template($field->value(), $replace);

        return $field;
    },

    'structureHeadlines' => function ($field, $fieldName = 'title') {

        $sections  = $field->toStructure();
        $headlines = new Collection;

        foreach($sections as $item) {
            $title = $item->{$fieldName}()->value();
            $headline = new Obj([
                'url'  => '#' . Str::slug(Str::unhtml($title)),
                'text' => trim(strip_tags($title)),
            ]);

            $headlines->append($headline->url(), $headline);
        }

        return $headlines;
    },

    'version' => function ($field, $format = '%s') {
        return $field->isEmpty() ? '' : version($field->value(), $format);
    }

];
