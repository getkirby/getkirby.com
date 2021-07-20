<?php

class GuidePage extends Page
{
    public function metadata(): array
    {
        $image = $this->images()->findBy('extension', 'svg');

        if ($image === null) {
            $image = $this->parents()->flip()->not(page('docs/guide')->parents())->images()->findBy('extension', 'svg');
        }

        return [
            'description' => strip_tags($this->intro()->kirbytags()),
            'thumbnail' => [
                'lead'  => $this->metaLead(page('docs/guide'), 'Guide'),
                'image' => $image
            ]
        ];
    }
    
}
