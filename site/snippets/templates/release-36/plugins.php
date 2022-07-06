<?php snippet('templates/features/section', [
  'id'	=> 'plugins',
  'title' => 'Panel areas',
  'intro' => 'The plugin API you’ve been dreaming of',
  'text'  => 'Our new Fiber architecture splits the Panel in areas: site area, users area, system area, etc. You can create your own areas and build entire applications on top of the Panel. <a href="/docs/reference/plugins/extensions/panel-areas">Learn more &rsaquo;</a>',
  'figure' => 'templates/release-36/plugins-figure',
  'reverse' => true,
  'features' => [
	[
	  'title' => 'Custom routes',
	  'text' => 'Building custom views with your own routes is now as simple as routing for your Kirby site. Define props for your view components and don\'t worry about API endpoints, state management or any other complex stuff. Just start building.'
	],
	[
	  'title' => 'Your own dialogs in seconds',
	  'text' => 'Dialogs can now also be defined in PHP and opened with a simple JS call `$dialog("my-dialog")`. Create form dialogs, text dialogs or confirmation dialogs to delete entries. It’s so much fun.'
	],
	[
	  'title' => 'Access control made simple',
	  'text' => 'You want your own permissions for your shiny new Panel area? No problem. It’s automatically handled for you. Deny access for individual roles and the Panel will make sure to keep those users out.'
	],
	[
	  'title' => 'No more API endpoint hassle',
	  'text' => 'With Fiber, you return exactly the data you need for your Panel components. Goodbye to multiple API calls or custom API routes. Write some PHP and be done.'
	],
  ]
]);
