<?php

use Kirby\Cms\KirbyText;

Kirby::plugin('getkirby/columns', [
    'hooks' => [
        'kirbytags:before' => function ($text, array $data = []) {

            $text = preg_replace_callback('!\(columns(…|\.{3})\)(.*?)\((…|\.{3})columns\)!is', function ($matches) use ($data) {

                $columns = preg_split('!(\n|\r\n)\+{4}\s+(\n|\r\n)!', $matches[2]);
                $html    = [];

                foreach($columns as $column) {
                    $html[] = '<div class="' . $this->option('columns.item', 'column') . '">' . $this->kirbytext($column, $data) . '</div>';
                }

                return '<div class="' . $this->option('columns.container', 'columns') . ' ' . $this->option('columns.container', 'columns') . '-' . count($columns) . '">' . implode($html) . '</div>';

            }, $text);

            return $text;

        },
    ]
]);
