<?php

snippet('templates/features/section', [
	'id'    => 'panel',
	'title' => 'Panel UI',
	'intro' => 'More customizable than ever',
	'text'  => 'Of course this release is not just about Fiber. We’ve refactored our Panel CSS and started building new layout types to give you even more control.',
	'figure' => 'templates/release-36/panel-figure',
	'features' => [
		[
			'title' => 'Copy & paste for blocks',
			'text' => 'With 3.6, you can now copy and paste blocks between block and layout fields and even import blocks from HTML or text. This lifts the blocks field on an entirely new level in terms of usability.',
			'link' => '/releases/3.6/features#panel__blocks-and-layouts'
		],
		[
			'title' => 'New formats for the writer field',
			'text' => 'Enable headings and list block formats for your writer fields and simplify WYSIWYG editing for your users.',
			'link' => '/releases/3.6/features#panel__improved-ux'
		],
		[
			'title' => 'CSS variables',
			'text' => 'Every little detail of the Panel is now defined as a CSS variable. What’s great about that? You can overwrite our variables in your <code>panel.css</code>. Custom Panel themes just got so much easier.',
			'link' => 'https://lab.getkirby.com/public/lab/basics/design'
		],
		[
			'title' => 'It’s all in the details',
			'text' => 'An improved duplicate dialog, a new email dialog for writer fields, customizable navigation options, a customizable favicon and more. We’ve improved tons of smaller Panel details in this release.',
			'link' => '/releases/3.6/features'
		],
	]
]);
