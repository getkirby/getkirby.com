<?php snippet('templates/features/section', [
  'id'    => 'panel',
  'title' => 'Panel UI',
  'intro' => 'Even more customizable',
  'text'  => 'Of course this release is not just about Fiber. We’ve refactored our Panel CSS and started building new layout types to give you even more control.',
  'figure' => 'templates/release-36/cardlets-figure',
  'features' => [
    [
      'title' => 'New cardlets',
      'text' => 'They are finally here! We’ve been showing them more than a year ago and the time is finally right. Cardlets are now available everywhere and can be used instead of lists or cards. They are the perfect mixture between visual and text content.',
      'link' => '/releases/3.6/features/cardlets'
    ],
    [
      'title' => 'CSS variables',
      'text' => 'Every little detail of the Panel is now defined as a CSS variable. What’s great about that? You can overwrite our variables in your panel.css. Custom Panel themes just got so much easier.',
      'link' => '/releases/3.6/features/custom-properties'
    ],
  ]
]);
