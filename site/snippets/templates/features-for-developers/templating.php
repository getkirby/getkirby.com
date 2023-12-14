<?php

snippet('templates/features/section', [
	'id' => 'templating',
	'title' => 'Templating',
	'intro' => 'Stay in control of your markup.<br>Keep your projects lean.',
	'text'  => 'Kirby comes with a powerful PHP-based template engine. Optimized for speed and equipped with an ultra flexible and intuitive PHP API, you can build your perfect frontend the way you like.',
	'figure' => 'templates/features-for-developers/templating-figure',
	'reverse' => true,
	'voice' => 'rene-stalder',
	'features' => [
		[
			'title' => 'Controllers',
			'text' => 'Complex logic? Use Kirby’s controllers to filter data collections based on URL query parameters, handle forms, do date-based calculations and more without cluttering your templates. Marie Kondō agrees.',
			'link' => '/docs/guide/templates/controllers'
		],
		[
			'title' => 'Models',
			'text' => 'Super-charge your pages with additional functionalities. Page models extend our default page class and offer unlimited opportunities to customize what a page represents.',
			'link' => '/docs/guide/templates/page-models'
		],
		[
			'title' => 'Collections',
			'text' => 'Keep your code DRY with collections. Featured articles, upcoming events, team members – create reusable collections that you can use everywhere.',
			'link' => '/docs/guide/templates/collections'
		],
		[
			'title' => 'Bring your own engine',
			'text' => 'Your team is familiar with Twig, Blade or your own template engine? No problem! Our engine can be swapped using a template plugin, or you can create your own.',
			'link' => '/docs/reference/plugins/components/template'
		],
	]
]);
