<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Pages;
use Kirby\Cms\Field;
use Kirby\Cms\Html;
use Kirby\Cms\Page;
use Kirby\Toolkit\F;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class ReferenceValidatorsPage extends Page
{

    public function children()
    {
        $children   = [];
        $validators = V::$validators;
        $pages      = parent::children();

        foreach ($validators as $key => $validator) {

            $slug = Str::kebab($key);

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [
                    'undocumented' => true,
                ];
            }

            $children[] = [
                'slug'     => $slug,
                'num'      => 0,
                'model'    => 'validator',
                'template' => 'validator',
                'parent'   => $this,
                'content'  => $content
            ];
        }

        return Pages::factory($children, $this);
    }

}
