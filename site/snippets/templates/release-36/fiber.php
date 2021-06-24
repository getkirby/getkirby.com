<?php snippet('templates/features/section', [
  'id'    => 'fiber',
  'title' => 'Fiber',
  'intro' => 'Our architecture for the future',
  'text'  => 'We’ve spent the last months working on a brand new backend architecture for the Panel. Moving from a single page application to a more traditional approach with a simplified server-rendered backend. The new architecture is inspired by Inertia.js and simplifies our Panel and Panel plugins in ways that we’ve never dreamed of.',
  'figure' => 'templates/release-36/fiber-figure',
  'footer' => 'templates/release-36/fiber-footer',
  'features' => [
    [
      'title' => 'Drastically reduced bundle size',
      'text' => 'Moving to Fiber means being able to massively reduce the complexity and bundle size of the Panel. <strong>We shaved off more than 100kb of uncompressed Javascript</strong> and will likely manage to shave off even more. 🤯'
    ],
    [
      'title' => 'Super simple plugins',
      'text' => 'While Panel plugins were already extremely powerful, they were also quite complex to build. With the new backend architecture, we can handle many tasks on the server now. Building views, dialogs and more is so much easier now. No need to be a Vue.js expert anymore.'
    ],
    [
      'title' => 'Better performance',
      'text' => 'With a smaller bundle size and less requests, we can increase the Panel performance for all users and keep it fast and lean with a growing number of features and plugins. New views and new dialogs no longer add to the bundle size. It’s the JS diet we’ve been looking for.'
    ],
    [
      'title' => 'Future proof',
      'text' => 'The new architecture paves the way for many fantastic features that have not been possible before. '
    ],
  ]
]);
