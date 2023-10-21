<style>
.roadmap {
  position: relative;
}
.roadmap::after,
.roadmap li::after {
  position: absolute;
  left: 1.5rem;
  right: 0;
  bottom: -.75rem;
  content: "";
  height: 2px;
  background: var(--color-black);
}
.roadmap li {
  position: relative;
}
.roadmap li::after {
  width: 2px;
  height: .75rem;
  right: auto;
}
.roadmap li:last-child::after {
  background: none;
  left: auto;
  right: 0;
  width: auto;
  height: auto;
  bottom: calc(-.75rem - 5px);
  border-top: 6px solid transparent;
  border-left: 6px solid var(--color-black);
  border-bottom: 6px solid transparent;
}
</style>

<section id="roadmap" class="mb-42">
  <?php snippet('templates/features/intro', [
    'title' => 'Long-term thinking',
    'intro' => 'Backed by a sustainable business',
    'text'  => 'We know how important it is that you can trust your content management system not to vanish the next day. That’s why we build our business on a sustainable model with a reliable roadmap. Kirby has been around and profitable for over a decade. We plan for the next decade.'
  ]) ?>
  <ul class="roadmap flex justify-between mb-24">
    <li style="flex-grow: 1">
      <p class="h2">beta</p>
      <p class="font-mono text-xs">early 2011</p>
    </li>
    <li style="flex-grow: 2">
      <p class="h2">1.0</p>
      <p class="font-mono text-xs">January 2012</p>
    </li>
    <li style="flex-grow: 4">
      <p class="h2">2.0</p>
      <p class="font-mono text-xs">Mid 2014</p>
    </li>
    <li style="flex-grow: 4">
      <p class="h2">3.0</p>
      <p class="font-mono text-xs">January 2019</p>
    </li>
		<li style="flex-grow: 2">
      <p class="h2">4.0</p>
      <p class="font-mono text-xs">November 2023</p>
    </li>
    <li></li>
  </ul>

  <ul class="columns rounded overflow-hidden" style="--columns: 3; --gap: var(--spacing-1)">
    <?php foreach ([
      [
        'title' => 'Future-proof',
        'text'  => 'Kirby helps you grow and maintain projects after launch. React to client requests and requirement changes immediately and efficiently. Never be afraid of unexpected road-blocks anymore.',
      ],
      [
        'title' => 'No lock-in',
        'text'  => 'We want to keep you as customers for as long as possible. But we don’t want to lock you in. Kirby’s content structure is open and easy to migrate to any other system. This is all about giving you confidence in our system.',
      ],
      [
        'title' => 'Professional support',
        'text'  => 'With dedicated support in (link: https://forum.getkirby.com/ text: our forum class: underline), a direct communication channel on (link: https://chat.getkirby.com text: our chat server class: underline) or via (email: support@getkirby.com text: email class: underline) and optional team workshops, we are here to help you and your team.',
      ]
    ] as $feature): ?>
    <li class="bg-light p-6">
      <?php snippet('templates/features/feature', ['feature' => $feature]) ?>
    </li>
    <?php endforeach ?>
  </ul>
</section>
