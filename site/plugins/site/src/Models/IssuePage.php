<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Page;

class IssuePage extends Page
{

    public function metadata(): array
    {
        return [
            'description' => 'Read issue no. ' . $this->uid() . ' of our montly newsletter online.',
            'thumbnail' => $this->image(),
            'ogtitle' => 'Kirby Kosmos Episode ' . $this->uid(),
            'changefreq' => 'never',
        ];
    }
}
