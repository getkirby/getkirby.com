<?php


class ReferenceArticlePage extends Page
{

    public function metadata(): array
    {
        return [
            'description' => strip_tags($this->excerpt()->kirbytags()),
            'thumbnail' => [
                'lead'  => $this->metaLead(page('docs/reference'))
            ]
        ];
    }

}
