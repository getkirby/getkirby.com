<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class IssuePage extends Page
{

    public function metadata(): array
    {
        return [
            'description' => function () {
                return 'Read issue no. ' . $this->uid() . ' of our montly newsletter online.';
            },
            'thumbnail' => function() {
                return $this->image();
            },
            'ogtitle' => function() {
              return 'Kirby Kosmos Episode ' . $this->uid();
            }
        ];
    }
}
