<?php snippet('templates/features/section', [
  'id'    => 'fiber',
  'title' => 'Fiber',
  'intro' => 'Our architecture for the future',
  'text'  => 'We’ve spent the last months working on a brand new backend architecture for the Panel. Moving from a single page application to a more traditional approach with a simplified server-rendered backend. The new architecture is inspired by Inertia.js and simplifies our Panel and Panel plugins in ways that we’ve never dreamed of. <a href="/releases/3.6/features/fiber">Learn more &rsaquo;</a>',
  'figure' => 'templates/release-36/fiber-figure',
  'footer' => 'templates/release-36/fiber-footer',
  'features' => [
    [
      'title' => 'Drastically reduced bundle size',
      'text' => 'With the move to Fiber, we massively reduce the complexity and bundle size of the Panel. <strong>We shaved off more than 100kb of uncompressed Javascript</strong> and will likely manage to shave off even more. 🤯'
    ],
    [
      'title' => 'Super simple plugins',
      'text' => 'Panel plugins were already extremely powerful, but quite complex to build. With the new backend architecture, we handle many tasks on the server. Building views, dialogs and more is therefore far easier now. No need to be a Vue.js expert anymore.'
    ],
    [
      'title' => 'Better performance',
      'text' => 'With the smaller bundle size and fewer requests, the Panel becomes more performant for everyone, and will stay fast and lean even with a growing number of features and plugins. New views and dialogs no longer add to the bundle size. It’s the JS diet we’ve been looking for.'
    ],
    [
      'title' => 'Future proof',
      'text' => 'The new architecture paves the way for many fantastic features that have not been possible before. '
    ],
  ]
]);
