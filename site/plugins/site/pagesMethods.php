<?php

return [
    
    'forCheatsheet' => function () {
        $advanced = param('advanced') === 'true';
        $entries  = $this->listed();
  
        if ($advanced === false) {
            $entries = $entries->filter(function ($p) {
                if (method_exists($p, 'isInternal') && method_exists($p, 'isDeprecated')) {
                    return !$p->isInternal() && !$p->isDeprecated();
                }
                return  true;
            });
        }
        
        return $entries;
    },
    
    'hasAdvanced' => function () {
        return $this->listed()->count() !== $this->forCheatsheet()->count();
    }
];
