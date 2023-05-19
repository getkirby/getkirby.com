<section id="changes" class="mb-36">

  <h2 class="h2 mb-6">Planned Changes</h2>
  <ul class="columns" style="--columns: 3; --gap: var(--spacing-1)">
    <?php foreach ([
      [
        'title' => 'Same proven architecture',
        'text'  => 'We are not making a generation jump with a rewrite this time like we did from Kirby 2 to Kirby 3. Instead we are building on the solid foundation that we built with Kirby 3 and continously improved in every release since then. <br><br>We consider stability and reliability core features of Kirby, so it is really important to us to keep the continuity. While Kirby 4 will come with many great new features and enhancements, it is not a departure from Kirby 3 as much as the name may make it sound like.',
      ],
      [
        'title' => 'Focus on your requests',
        'text'  => 'Our <a class="link" href="https://feedback.getkirby.com">feedback platform</a> is full of amazing feature suggestions and requests and we are currently focusing on implementing highly requested features for this new version.<br><br>The Panel will see the most significant changes and many new exciting improvements. <br><br>While Kirby 4 isn’t going to be generation jump, we are confident that it will be a significant step for your projects.',
      ],
      [
        'title' => 'Compatibility',
        'text'  => 'Kirby’s plugin and theme ecosystem is going strong. We plan to keep plugins and themes compatible without major changes. There might be similar smaller adjustments necessary as we’ve seen in previous 3.x releases. We will help to get them solved during the beta and also intend to get our plugin developers involved early in the process.<br><br>The same is true for your installations. You won’t be starting from scratch. Kirby 4 will elevate your existing Kirby 3 projects.',
      ]
    ] as $feature): ?>
    <li class="bg-light p-6">
      <?php snippet('templates/features/feature', ['feature' => $feature]) ?>
    </li>
    <?php endforeach ?>
  </ul>

</section>

