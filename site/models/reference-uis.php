<?php

use Kirby\Cms\Pages;
use Kirby\Reference\SectionPage;

class ReferenceUisPage extends SectionPage
{

    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }


        $root     = $this->kirby()->root('assets') . '/ui.json';
        $data     = Data::read($root);
        $pages    = parent::children();
        $children = [];

        foreach ($data as $ui) {
            // only include components that
            // have been flagged as public
            $internal = $ui['tags']['internal'] ?? null;

            if ($internal !== null) {
                continue;
            }

            $slug = Str::kebab($ui['displayName']);

            if ($page = $pages->find($slug)) {
                $content = $page->content()->toArray();
            } else {
                $content = [];
            }

            $content = array_merge([
                'title'       => $ui['displayName'],
                'description' => $ui['description'],
                'example'     => $ui['tags']['examples'][0]['content'] ?? null,
                'props'       => $ui['props'] ?? [],
                'methods'     => $ui['methods'] ?? [],
                'events'      => $ui['events'] ?? [],
                'slots'       => $ui['slots'] ?? [],
                'source'      => $ui['srcFile'],
                'data'        => $ui
            ], $content);

            // Sort lists
            array_multisort(
                array_column($content['props'], 'name'),
                SORT_ASC,
                $content['props']
            );
            array_multisort(
                array_column($content['methods'], 'name'),
                SORT_ASC,
                $content['methods']
            );
            array_multisort(
                array_column($content['events'], 'name'),
                SORT_ASC,
                $content['events']
            );
            array_multisort(
                array_column($content['slots'], 'name'),
                SORT_ASC,
                $content['slots']
            );

            $children[] = [
                'slug'     => $slug,
                'template' => 'reference-ui',
                'model'    => 'reference-ui',
                'num'      => 0,
                'content'  => $content
            ];
        }

        return $this->children = Pages::factory($children, $this)->sortBy('title', 'asc');
    }

}
