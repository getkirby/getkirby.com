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

    ],

    // Look for <code> tags that contain type definitions, such as
    // <code>string</code> or `string`and colorize them. If inline
    // code contains a class name, also add a link to the class in
    // the reference.
    'kirbytags:after' => function(string $text = null, array $data = []) {

        // $text = preg_replace_callback('!<code>(.*)</code>!siU', function($match) {
        //     return formatType($match[1]);
        // }, $text);

        // Now handled by the Maki plugin.
        // $text = preg_replace_callback('!`([a-z_]+)`!iU', function($match) {
        //     return formatType($match[1]);
        // }, $text);

        return $text;
    },
    'kirbytags:after' => function(string $text = null, array $data = []) {

        // SINCE
        return preg_replace_callback('!<since v="([0-9.]+)">(.*)</since>!siU', function($match) use ($data) {
            // Prepare comparison to current version
            $versions = explode('.', $match[1]);
            $current  = explode('.', $this->version());

            $block  = '<div class="since-version">';
            $block .= '<span class="version-badge';

            // If within the current mayor release,
            // mark as current
            if (
                $current[0] === $versions[0] &&
                $current[1] === $versions[1]
            ) {
                $block .= ' current';
            }

            $block .= '">Since <code>' . version($match[1], '%s') . '</code></span>';
            $block .= $this->kirbytext($match[2], $data);
            $block .= '</div>';

            return $block;

        }, $text);

    }
];
