<?php

snippet('templates/features/section', [
	'id' => 'plugins',
	'title' => 'Plugins',
	'intro' => 'Endless options for projects without roadblocks',
	'text'  => 'Say yes with confidence when the client asks for changes. Pretty much any aspect of Kirby can be extended - with <a href="https://plugins.getkirby.com">existing plugins</a> or custom solutions for your project.',
	'figure' => 'templates/features-for-developers/plugins-figure',
	'reverse' => true,
	'voice' => 'warchamp7',
	'features' => [
		[
			'title' => 'Custom sections & fields',
			'text' => 'Add entirely new interface elements to the Panel with custom sections. Integrate data from analytics tools, your ERM system, third-party services and more and use them seamlessly alongside your content. Use the power of Vue.js to create truly interactive plugins.'
		],
		[
			'title' => 'Hooks',
			'text' => 'React to specific events with hooks and trigger your own actions. Resize a file on upload, add data to a newly created page, add custom content validations and more.'
		],
		[
			'title' => 'Core components',
			'text' => 'You don\'t like our template engine, Markdown parser or media API? Simply swap out major parts of the Kirby system with your own plugins.',
			'link' => '/docs/reference/plugins/components'
		],
		[
			'title' => 'Routes',
			'text' => 'Routing has never been easier: Kirby comes with a powerful router that can be extended to adjust the URL scheme, handle form submissions, add webhook endpoints or create virtual pages.',
			'link' => '/docs/guide/routing'
		]
	]
]);
