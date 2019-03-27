<?php

use Kirby\Cms\Response;

/**
 * Pages for visual regression tests using backstop. These
 * are currently hard-coded, as generating a sitemap would
 * result in thousands of pages. Takes screenshots of every
 * single one would take days.
 */
$backstop_urlmap = [
  '',
  'docs/guide',
  'docs/cookbook',
  'docs/cookbook/forms/basic-contact-form',
  'docs/cookbook/i18n/import-export',
  'docs/reference',
  'docs/reference/plugins/ui',
  'docs/reference/panel/fields/text',
  'docs/glossary',
  'docs/archive',
  'community',
  'news',
  'kosmos/32',
  'try',
  'love',
  'buy',
  'search',
  'privacy',
  'license',
  'contact',
  'press',
  'styleguide',
];

Kirby::plugin('getkirby/backstop', [
  'routes' => [
    [
      'pattern' => 'backstop-scenarios',
      'action' => function() use ($backstop_urlmap) {
        
        $scenarios = [];


        $root = dirname(realpath('.')); // go one level up from `index.php` in public folder
        $defaultConfig   = $root . '/config.default.json';
        $userConfig      = $root . '/config.json';

        $config = json_decode(file_get_contents($defaultConfig), true);
        if (file_exists($userConfig)) {
          $config = array_merge($config, json_decode(file_get_contents($userConfig), true));
        }
        
        foreach ($backstop_urlmap as $scenario) {
          $scenarios[] = [
            'label' => ($page = page($scenario)) ? $page->title()->value() : $scenario,
            'url' => "http://{$config['host']}/{$scenario}",
          ];
        }
        
        return Response::json([
          'scenarios' => $scenarios
        ]);
      },
    ]
  ],
]);
