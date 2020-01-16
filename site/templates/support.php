<?php snippet('header') ?>

<main class="support-page | main" id="maincontent">

  <div class="wrap">

    <header class="support-page-hero hero">
      <h1><?= $page->title() ?></h1>
      <div class="intro -mb:medium">
        <?= $page->intro()->kt() ?>
      </div>
    </header>


    <div class="columns">
      <header class="column -mb:large">
        <h2 id="team" class="h2">When in trouble</h2>
        <p class="intro">
          Reach out on the following channels:
          <a href="">forum.getkirby.com</a><br>
          <a href="">Report a bug</a><br>
        </p>
      </header>

      <header class="column -mb:large">
        <h2 id="team" class="h2">Get involved</h2>
        <p class="intro">
          Contribute your ideas:<br>
          <a href="">Feature Requests</a>
        </p>
        <br>
        <p class="intro">
          Spread the word:<br>
          <a href="">Instagram</a><br>
          <a href="">Twitter</a><br>
        </p>
      </header>
    </div>

    <div class="columns">
      <header class="column -mb:large">
        <h2 id="team" class="h2">For agencies</h2>
        <p class="intro">
          You want to get to know Kirby better? Get in touch:<br>
          <a href="">Schedule a demo or workshop</a><br>
        </p>
      </header>

      <header class="column -mb:large">
        <h2 id="team" class="h2">Security reports</h2>
        <p class="intro">
          Reach out responsibly if you found any security issue in Kirby:
          <a href="">security@getkirby.com</a><br>
        </p>
      </header>
    </div>




    <!-- # Team Section -->
    <section class="support-team-section | section">

      <header class="-mb:large">
        <h2 id="team" class="h2">Team</h2>
        <p class="intro">
          Kirby grew from a one-man show to a team of dedicated developers, designers and writers.
        </p>
      </header>

      <ul class="support-mates | -mb:huge">
        <?php foreach ($mates as $mate) : ?>
          <li class="support-mate">

            <figure class="-mb:small screenshot">
              <span class="intrinsic" style="padding-bottom: 100%">
                <?= $mate->image()->html(['alt' => $mate->title()]) ?>
              </span>
            </figure>

            <h3 class="h5"><?= $mate->title() ?><br></h3>

            <p class="-mb:medium">
              <small><?= $mate->role() ?></small>
            </p>

            <ul class="support-mate-links">
              <?php if ($mate->website()->isNotEmpty()) : ?>
                <li>
                  <a href="<?= $mate->website() ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16">
                      <g class="nc-icon-wrapper" fill="#0d0f12">
                        <path fill="#0d0f12" d="M8,0C3.6,0,0,3.6,0,8s3.6,8,8,8s8-3.6,8-8S12.4,0,8,0z M13.9,7H12c-0.1-1.5-0.4-2.9-0.8-4.1 C12.6,3.8,13.6,5.3,13.9,7z M8,14c-0.6,0-1.8-1.9-2-5H10C9.8,12.1,8.6,14,8,14z M6,7c0.2-3.1,1.3-5,2-5s1.8,1.9,2,5H6z M4.9,2.9 C4.4,4.1,4.1,5.5,4,7H2.1C2.4,5.3,3.4,3.8,4.9,2.9z M2.1,9H4c0.1,1.5,0.4,2.9,0.8,4.1C3.4,12.2,2.4,10.7,2.1,9z M11.1,13.1 c0.5-1.2,0.7-2.6,0.8-4.1h1.9C13.6,10.7,12.6,12.2,11.1,13.1z"></path>
                      </g>
                    </svg>
                  </a>
                </li>
              <?php endif ?>
              <?php if ($mate->twitter()->isNotEmpty()) : ?>
                <li>
                  <a href="https://twitter.com/<?= $mate->twitter() ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16">
                      <g class="nc-icon-wrapper" fill="#0d0f12">
                        <path fill="#0d0f12" d="M16,3c-0.6,0.3-1.2,0.4-1.9,0.5c0.7-0.4,1.2-1,1.4-1.8c-0.6,0.4-1.3,0.6-2.1,0.8c-0.6-0.6-1.5-1-2.4-1 C9.3,1.5,7.8,3,7.8,4.8c0,0.3,0,0.5,0.1,0.7C5.2,5.4,2.7,4.1,1.1,2.1c-0.3,0.5-0.4,1-0.4,1.7c0,1.1,0.6,2.1,1.5,2.7 c-0.5,0-1-0.2-1.5-0.4c0,0,0,0,0,0c0,1.6,1.1,2.9,2.6,3.2C3,9.4,2.7,9.4,2.4,9.4c-0.2,0-0.4,0-0.6-0.1c0.4,1.3,1.6,2.3,3.1,2.3 c-1.1,0.9-2.5,1.4-4.1,1.4c-0.3,0-0.5,0-0.8,0c1.5,0.9,3.2,1.5,5,1.5c6,0,9.3-5,9.3-9.3c0-0.1,0-0.3,0-0.4C15,4.3,15.6,3.7,16,3z"></path>
                      </g>
                    </svg>
                  </a>
                </li>
              <?php endif ?>
              <?php if ($mate->github()->isNotEmpty()) : ?>
                <li>
                  <a href="https://github.com/<?= $mate->github() ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16">
                      <g class="nc-icon-wrapper" fill="#0d0f12">
                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#0d0f12" d="M8,0.2c-4.4,0-8,3.6-8,8c0,3.5,2.3,6.5,5.5,7.6 C5.9,15.9,6,15.6,6,15.4c0-0.2,0-0.7,0-1.4C3.8,14.5,3.3,13,3.3,13c-0.4-0.9-0.9-1.2-0.9-1.2c-0.7-0.5,0.1-0.5,0.1-0.5 c0.8,0.1,1.2,0.8,1.2,0.8C4.4,13.4,5.6,13,6,12.8c0.1-0.5,0.3-0.9,0.5-1.1c-1.8-0.2-3.6-0.9-3.6-4c0-0.9,0.3-1.6,0.8-2.1 c-0.1-0.2-0.4-1,0.1-2.1c0,0,0.7-0.2,2.2,0.8c0.6-0.2,1.3-0.3,2-0.3c0.7,0,1.4,0.1,2,0.3c1.5-1,2.2-0.8,2.2-0.8 c0.4,1.1,0.2,1.9,0.1,2.1c0.5,0.6,0.8,1.3,0.8,2.1c0,3.1-1.9,3.7-3.7,3.9C9.7,12,10,12.5,10,13.2c0,1.1,0,1.9,0,2.2 c0,0.2,0.1,0.5,0.6,0.4c3.2-1.1,5.5-4.1,5.5-7.6C16,3.8,12.4,0.2,8,0.2z"></path>
                      </g>
                    </svg>
                  </a>
                </li>
              <?php endif ?>
            </ul>

          </li>
        <?php endforeach ?>
      </ul>

    </section>

  </div>

</main>

<?php snippet('footer') ?>
