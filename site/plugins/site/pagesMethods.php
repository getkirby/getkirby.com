<?php

return [
    
    'forCheatsheet' => function () {
        if (param('advanced') === 'true') {
            return $this->listed();
        }
        
        return $this->simple();
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
