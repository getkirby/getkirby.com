<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;

use Kirby\Reference\ReflectionSection;

class ReferenceHooksPage extends ReflectionSection
{

    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $pages    = parent::children();
        $children = array_map(function ($hook) use ($pages) {

            $slug = Str::slug($hook['Name']);

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $content = array_merge([
                'title'     => $hook['Name'],
                'arguments' => implode(', ', Str::split($hook['Arguments'])),
                'type'      => $hook['Type']
            ], $content);

            return [
                'slug'     => Str::slug($hook['Name']),
                'template' => 'reference.hook',
                'model'    => 'reference.hook',
                'num'      => 0,
                'content'  => $content
            ];
        }, csv($this->root() . '/hooks.csv'));

        return $this->children = Pages::factory($children, $this);
    }
}
