<?php

use Kirby\Cms\Field;
use Kirby\Cms\Pages;

class ReferenceQuickLinkPage extends Page
{

    /**
     * Creates children collection from `menu` content field
     *
     * @return \Kirby\Cms\Pages
     */
    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        $children = static::childrenFromContentField($this->menu());
        return $this->children = Pages::factory($children, $this);
    }

    /**
     * Returns quicklinks children array for field values
     *
     * @param \Kirby\Cms\Field $field
     * @return array
     */
    public static function childrenFromContentField(Field $field): array
    {
        $children = [];

        if ($field->isNotEmpty()) {
            foreach ($field->yaml() as $menu) {
                // Add separator pages
                if ($menu === '--') {
                    $children[] = [
                        'slug'     => Str::random(3),
                        'template' => 'separator',
                        'num'      => 0
                    ];
                } else {
                    $children[] = [
                        'slug'     => basename($menu),
                        'model'    => 'reference-quicklink',
                        'template' => 'reference-quicklink',
                        'num'      => 0,
                        'content'  => [
                            'link'  => 'docs/reference/' . $menu
                        ]
                    ];
                }
            }
        }

        return $children;
    }

    /**
     * Returns whether the referenced page is open
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        $link = $this->link()->toPage();
        return $link ? $link->isOpen() : false;
    }

    public function template()
    {
        return $this->kirby()->template('link');
    }

    public function title(): Field
    {
        $title = $this->content()->get('title');

        if ($title->isNotEmpty()) {
            return $title;
        }

        $link = $this->link()->toPage();
        return new Field($this, 'title', $link ? $link->title() : null);
    }

}
