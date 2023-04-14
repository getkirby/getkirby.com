<?php

use Kirby\Cms\Pages;
use Kirby\Data\Data;
use Kirby\Filesystem\F;
use Kirby\Http\Remote;
use Kirby\Reference\SectionPage;
use Kirby\Toolkit\Str;

class ReferenceUisPage extends SectionPage
{
    public function children(): Pages
    {
        if ($this->children !== null) {
            return $this->children;
        }

        // give preference to local JSON file
        $local = $this->kirby()->root('kirby') . '/panel/dist/ui.json';

        if (F::exists($local) === true) {
            $data = Data::read($local);

        } else {
            // otherwise try to load from cache
            $cache  = $this->kirby()->cache('reference');
            $data   = $cache->get('ui');
        }

        // load JSON from remote server if not cached yet
        // and write it to cache
        if ($data === null) {
            $data = Remote::get('https://ui.getkirby.com/index.json')->json();

            // only include components that
            // have been flagged as public
            $data = array_filter(
                $data,
                fn ($ui) => ($ui['tags']['internal'] ?? null) === null
            );

            $cache->set('ui', $data);
        }

        $pages    = parent::children();
        $children = [];

        foreach ($data as $ui) {
            $slug    = Str::kebab($ui['displayName']);
            $content = $pages->find($slug)?->content()->toArray() ?? [];
            $content = array_merge([
                'title'       => ucfirst(strtolower(trim(implode(' ',preg_split('/(?=[A-Z])/', $ui['displayName']))))),
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
