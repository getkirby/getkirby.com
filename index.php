<?php

include './kirby/vendor/autoload.php';

$options = [];

if(in_array(Url::host(), ['getkirby.com', 'staging.getkirby.com'])) {
    $options['urls'] = ['assets' => 'dist'];
}

echo (new Kirby($options))->render();