<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\F;

use Kirby\Reference\ReflectionSection;

class ReferenceIconsPage extends ReflectionSection
{

    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children = [];
        $root     = $this->kirby()->root('panel') . '/dist/img/icons.svg';
        $file     = F::read($root);
        $svg      = new SimpleXMLElement($file);

        foreach ($svg->defs->children() as $symbol) {
            $slug = str_replace('icon-', '', $symbol->attributes()->id);
            $children[] = [
                'slug'     => $slug,
                'template' => 'reference.icon',
                'model'    => 'reference.icon',
                'num'      => 0,
                'content'  => [
                    'excerpt' => '&lt;k-icon type="' . $slug . '"&gt;'
                ]
            ];
        }

        return $this->children = Pages::factory($children, $this)
            ->sortBy('slug');
    }
}
