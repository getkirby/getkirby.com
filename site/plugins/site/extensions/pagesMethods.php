<?php

use Kirby\Http\Cookie;

return [
    'filtered' => function () {
        return $this->listed()->filter(function ($child) {
            $vetos = [];

            if (method_exists($child, 'isPublic') === true) {
                $vetos[] = $child->isPublic() === false;
            }

            if (method_exists($child, 'isInternal') === true) {
                $vetos[] = $child->isInternal() === true;
            }

            if (method_exists($child, 'isDeprecated') === true) {
                $vetos[] = $child->isDeprecated() === true;
            }

            return count(array_filter($vetos)) === 0;
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
