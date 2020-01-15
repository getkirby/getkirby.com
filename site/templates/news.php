<?php snippet('header', ['background' => 'dark' ]) ?>

  <main class="news-page | main" id="maincontent">

    <!-- # Kosmos Section -->

    <section class="kosmos | wrap">
      <?php snippet('hero', ['align' => 'left', 'theme' => 'dark', 'page' => $kosmos]) ?>
      <?php snippet('kosmos-form') ?>

      <div class="kosmos-issues-heading">
        <h2 class="h3 -color:yellow-on-dark">Latest issues</h2>
        <?php snippet('arrow-link', ['link' => $kosmos->url(), 'text' => 'View all']) ?>
      </div>

      <?php snippet('kosmos-issues', [
        'issues' => page('kosmos')->children()->listed()->flip()->limit(4),
      ]) ?>
    </section>

    <section class="wrap">
      <ul class="updates">
        <li>
          <a href="https://twitter.com/getkirby">
            <p><?php icon('twitter') ?></p>
            <h2 class="h3 -color:yellow-on-dark">Twitter</h2>
            <p>Follow us on Twitter for short updates. We still use it. Don't ask why.</p>
          </a>
        </li>
        <li>
          <a href="https://instagram.com/getkirby">
            <p><?php icon('instagram') ?></p>
            <h2 class="h3 -color:yellow-on-dark">Instagram</h2>
            <p>#tryingtobecool #cmshipster #bandwagon</p>
          </a>
        </li>
        <li>
          <a href="https://github.com/getkirby/kirby/releases">
            <p><?php icon('github') ?></p>
            <h2 class="h3 -color:yellow-on-dark">Releases</h2>
            <p>You can find our change log and all releases on GitHub.</p>
          </a>
        </li>
      </ul>
    </section>

</main>

<?php snippet('footer', ['theme' => 'dark']) ?>
