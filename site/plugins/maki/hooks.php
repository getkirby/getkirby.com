<?php

return [

    'kirbytags:before' => [

        // BOXES
        function (string $text = null, array $data = []) {
            return preg_replace_callback('!<(warning|info)>(.*)<\/(warning|info)>!siU', function (array $matches) use ($data) {

                // box type
                $type = $matches[1];

                // icon
                $icon = icon($type, true, ['aria-hidden' => 'true']);

                // title
                $title  = ucfirst($type);
                $header = Html::p(['<strong>' . $title . ':</strong>'], [
                    'id'    => $id = uniqid(),
                    'class' => 'screen-reader-text'
                ]);

                // content
                $text = $this->kirbytext($matches[2], $data);

                return Html::aside([$icon, $header, $text], [
                    'class'           => $type,
                    'aria-labelledby' => $id
                ]);
            }, $text);
        },

        // SINCE
        function (string $text = null, array $data = []) {

            return preg_replace_callback('!<since v="([0-9.]+)">(.*)</since>!siU', function($match) use ($data) {
                $block  = '<div class="since-version">';
                $block .= '<span class="version-badge">Since <code>' . version($match[1], '%s') . '</code></span>';
                $block .= $this->kirbytext($match[2], $data);
                $block .= '</div>';

                return $block;

            }, $text);

        }

    ]

];
