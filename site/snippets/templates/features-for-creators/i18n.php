<?php snippet('templates/features/section', [
  'id'	=> 'internationalisation',
  'title' => 'Go global',
  'intro' => 'Built-in internationalization',
  'text'  => 'Kirby has multi-language support built right in. Get started with a single language and add additional translations later. Work together in a team to get your content out to an international audience around the world.',
  'figure' => 'templates/features-for-creators/i18n-figure',
  'reverse' => true,
  'features' => [
	[
	  'title' => 'Language management',
	  'text' => 'Create new content languages right in the Panel and start translating your pages immediately. Start with a single language and move to multiple languages later, or go global immediately – it’s up to your project.',
	],
	[
	  'title' => 'Create & translate',
	  'text' => 'Internationalization is built into the core of Kirby. Switch intuitively between different language versions and translate your content together with your team or on your own.'
	],
	[
	  'title' => 'Translatable URLs',
	  'text' => 'You can customize the main URL for each language, including subdomains. Combine this with translatable paths for pages to make your visitors feel at home.',
	  'link' => '/docs/guide/languages/translating-urls'
	],
	[
	  'title' => 'Integrations',
	  'text' => 'Are you using a translation service like Memsource? Use the amazing Memsource plugin to import and export translations for your translators right from the Panel.',
	  'link'  => 'https://github.com/OblikStudio/kirby-memsource'
	],
  ]
]);
