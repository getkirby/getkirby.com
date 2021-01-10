<?php

return [
    'filterForReference' => function (bool $simple = false) {
        $pages = $this->listed();

        $pages = $this->filterSimple();

        if (
            $simple === true ||
            Cookie::get('getkirby_advanced') != 'yes'
        ) {
            $pages = $pages->filter(function ($p) {
                if (
                    method_exists($p, 'isInternal') && 
                    method_exists($p, 'isDeprecated')
                ) {
                    return !$p->isInternal() && !$p->isDeprecated();
                }
                
                return  true;
            });
        }

        return $pages->sortBy('isMagic', 'desc', 'slug', 'asc');
    },

    'hasAdvancedChildren' => function () {
        return $this->filterForReference()->count() !== 
               $this->filterForReference(true)->count();
    },

    /* Legacy */
    'forCheatsheet' => function () {
        if (Cookie::get('getkirby_advanced') === 'yes') {
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
