<?php

use Kirby\Cms\App;
use Kirby\Cms\Site;
use Kirby\Data\Yaml;
use LexZander\KirbyKarbon\CarbonTxt;

load([
    'LexZander\\KirbyKarbon\\CarbonTxt' => 'lib/CarbonTxt.php',
], __DIR__);

App::plugin('lex-zander/karbon', [
    'blueprints' => [ 'tabs/karbon' => __DIR__ . '/blueprints/tabs/karbon.yml'],
    'translations' => [
        'en' => Yaml::read(__DIR__ . '/translations/en.yml'),
        'de' => Yaml::read(__DIR__ . '/translations/de.yml'),
    ],
    'hooks' => [
        'site.update:after' => function (Site $newSite, Site $oldSite) {
            $changed =
                $newSite->karbon_disclosures()->value() !== $oldSite->karbon_disclosures()->value() ||
                $newSite->karbon_services()->value() !== $oldSite->karbon_services()->value();

            if ($changed) {
                $newSite->update(['karbon_last_updated' => date('Y-m-d')], kirby()->defaultLanguage()?->code());
            }
        },
    ],
    'routes' => [
        [
            'pattern' => ['carbon.txt', '.well-known/carbon.txt'],
            'method'  => 'GET',
            'action' => fn () => CarbonTxt::response(),
        ]
    ],
]);
