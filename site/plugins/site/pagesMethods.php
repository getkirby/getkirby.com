<?php

return [

    'forCheatsheet' => function () {
        if (get('advanced') === 'true') {
            $pages = $this->listed();
        } else {
            $pages = $this->simple();
        }

        return $pages->sortBy('isMagic', 'desc', 'slug', 'asc');
    },

    'hasAdvanced' => function () {
        return $this->listed()->count() !== $this->simple()->count();
    },

    'simple' => function () {
        return $this->listed()->filter(function ($p) {
            if (method_exists($p, 'isInternal') && method_exists($p, 'isDeprecated')) {
                return !$p->isInternal() && !$p->isDeprecated();
            }
            return  true;
        });
    }
];
