<?php

use Kirby\Http\Cookie;

return [
    'filtered' => function () {
        return $this->listed()->filter(function ($child) {
            if (
                method_exists($child, 'isInternal') === true && 
                method_exists($child, 'isDeprecated') === true
            ) {
                return $child->isInternal() === false &&
                       $child->isDeprecated() === false;
            }

            return  true;
        });
    },
    'referenced' => function () {
        if (Cookie::get('getkirby$advanced') === 'yes') {
            $pages = $this->listed();
        } else {
            $pages = $this->filtered();
        }

        return $pages;
    },
];
