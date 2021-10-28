<?php

use Kirby\Cms\Pages;
use Kirby\Reference\SectionPage;

class ReferenceIconsPage extends SectionPage
{

    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $pages    = parent::children();
        $children = [];
        $root     = $this->kirby()->root('panel') . '/dist/img/icons.svg';
        $file     = F::read($root);
        $svg      = new SimpleXMLElement($file);

        foreach ($svg->defs->children() as $symbol) {
            $slug = str_replace('icon-', '', $symbol->attributes()->id);

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $children[] = [
                'slug'     => $slug,
                'template' => 'reference-icon',
                'model'    => 'reference-icon',
                'num'      => 0,
                'content'  => array_merge([
                    'intro' => '&lt;k-icon type="' . $slug . '"&gt;'
                ], $content)
            ];
        }

        return $this->children = Pages::factory($children, $this)
            ->sortBy('slug');
    }

}
