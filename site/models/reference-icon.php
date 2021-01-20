<?php

use Kirby\Reference\ReflectionPage;

class ReferenceIconPage extends ReflectionPage
{
    public function metadata(): array
    {
        return [
            'twittercard' => 'summary',
            'ogtitle'     => $this->slug() . ' icon',
            'description' => 'Preview of the ”' . $this->slug() . '“ icon.',
        ];
    }
}
