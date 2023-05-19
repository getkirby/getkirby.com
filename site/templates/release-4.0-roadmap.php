<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<style>
  .release-box,
  .release-code-box,
  .release-padded-box,
  .release-text-box {
    border-radius: .5rem;
    overflow: hidden;
    z-index: 1;
  }

  .release-code-box {
    display: grid;
    align-items: stretch;
    background: var(--color-black);
  }

  .release-code-box .code-toolbar {
    display: grid;
  }

  .release-padded-box,
  .release-text-box {
    padding: var(--spacing-6);
  }

  .release-text-box {
    background: var(--color-light);
  }

  .release-padded-box h3,
  .release-text-box h3 {
    font-weight: var(--font-bold);
    font-size: var(--text-lg);
  }

  .release-text-box .prose {
    font-size: var(--text-lg);
  }

  @media screen and (min-width: 60rem) {

    .release-text-box,
    .release-padded-box {
      padding: var(--spacing-12);
    }
  }

mark {
  background: var(--color-yellow-300);
}

</style>


<header class="mb-24">
  <h1 class="h1">Kirby 4</h1>
  <p class="h1 color-gray-600"><?= $page->subtitle() ?></p>
</header>

<article class="release-wrapper">

  <section class="mb-36">
    <h2 class="h2 mb-6">The gist of it</h2>

    <div class="columns" style="--columns: 3">
      <div class="p-6 bg-white shadow-xl rounded">
        <h2 class="font-bold mb-3">Kirby 4 will launch in 2023</h2>
        <p>We are very excited to announce that we are actively working on Kirby&nbsp;4 with many great user-facing features and improvements. We want to release a <mark>first beta around May</mark> and share our progress with you out in the open. Final release of <mark>v4 is scheduled for later this summer.</mark> 🚀</p>
      </div>
      <div class="p-6 bg-white shadow-xl rounded">
        <h2 class="font-bold mb-3">All licenses purchased in 2023 qualify as Kirby&nbsp;4 licenses</h2>
        <p><mark>We&nbsp;will treat any license bought on or after 1 Jan 2023 as if you bought it on the day of the v4 release.</mark> For older licenses, we will offer very fair upgrade prices as always. No worries if you recently bought a license.</p>
      </div>
      <div class="p-6 bg-white shadow-xl rounded">
        <h2 class="font-bold mb-3">Upgrades</h2>
        <p>Kirby 4 will be built upon the healthy code base we established for Kirby 3. <mark>Upgrades will be comparable to a 3.x release.</mark> While we stay on the same architecture, this new version will bring many long-awaited features and is going to move your projects forward. But more on this soon 😉</p>
      </div>
    </div>
  </section>

  <?php snippet('templates/release-40-roadmap/roadmap') ?>
  <?php snippet('templates/release-40-roadmap/versioning') ?>
  <?php snippet('templates/release-40-roadmap/changes') ?>

  <section id="updates" class="mb-36">
    <h2 class="h2 mb-6">Updates</h2>
    <div class="columns mb-24" style="--columns: 2; --gap: var(--spacing-12)">
      <div class="bg-white shadow-xl highlight">
        We are very excited for Kirby 4, a great next step for our CMS, and we can’t wait to share it with you. We really appreciate your continued support and are looking forward to taking you along for the ride. Stay tuned for teasers and more information about the upcoming beta.
      </div>
      <div>
        <h2 class="font-bold mb-6">Follow us for updates</h2>

        <ul class="font-mono text-sm">
          <li class="mb-3">
            <a class="flex items-center" href="https://mastodon.social/@getkirby">
              <figure class="mr-3 iconbox color-white bg-black" style="--size: 3rem"><?= icon('mastodon') ?></figure>
              Mastodon
            </a>
          </li>
          <li>
            <a class="flex items-center" href="https://chat.getkirby.com">
              <figure class="mr-3 iconbox color-white bg-black" style="--size: 3rem"><?= icon('discord') ?></figure>
              Discord
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section>
    <?php snippet('templates/features/intro', [
      'title' => 'Frequently asked questions',
      'text'  => 'We are getting a lot of questions after our announcement and already tried to answer most of them here. We will keep collecting questions from the community here and try to answer them as transparently as possible. Let us know on Discord or in the Forum if you have additional questions.'
    ]) ?>
    <?php snippet('faq') ?>
  </section>
</article>
