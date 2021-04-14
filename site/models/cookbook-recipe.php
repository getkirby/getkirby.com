<?php

class CookbookRecipePage extends Page
{
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
