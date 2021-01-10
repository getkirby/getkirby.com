<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

use Kirby\Reference\ReflectionSection;

class ReferenceValidatorsPage extends ReflectionSection
{
    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children   = [];
        $validators = array_keys(V::$validators);
        $pages      = parent::children();

        foreach ($validators as $validator) {
            $slug = Str::kebab($validator);

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $children[] = [
                'slug'     => $slug,
                'num'      => 0,
                'model'    => 'reference.validator',
                'template' => 'reference.validator',
                'parent'   => $this,
                'content'  => $content
            ];
        }

        return Pages::factory($children, $this);
    }

}
