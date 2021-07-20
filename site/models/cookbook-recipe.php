<?php

class CookbookRecipePage extends Page
{

    public function authors()
    {
        return parent::authors()->toPages();
    }

    public function isNew(): bool
    {
        return $this->published()->toDate('U') > (time() - 4500000);
    }

    public function metadata(): array
    {
        return [
            'thumbnail' => [
                'lead'  => 'Cookbook',
                'title' => $this->title()
            ]
        ];
    }
}
