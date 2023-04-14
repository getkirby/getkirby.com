<?php

use Kirby\Cms\Page;

class ReferenceArticlePage extends Page
{
    public function metadata(): array
    {
        return [
            'description' => strip_tags($this->intro()->kirbytags()),
            'thumbnail' => [
                'lead'  => $this->metaLead(page('docs/reference'))
            ]
        ];
    }
}
