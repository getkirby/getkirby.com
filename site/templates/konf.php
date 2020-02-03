<?php snippet('header', ['background' => 'dark' ]) ?>

<main class="konf-page | main" id="maincontent">

  <div class="konf-hero">
    <div class="wrap">
      <div class="konf-hero-layout">
        <div class="konf-hero-text">
          <?php snippet('hero', ['align' => 'left', 'theme' => 'dark']) ?>

          <a class="konf-hero-cta" href="#tickets">
            <?php icon('cart') ?>
            Tickets
          </a>
        </div>

        <div class="konf-hero-image">
          <?= $page->image('3st.jpg')->resize(800) ?>
        </div>
      </div>
    </div>

  </div>

  <div class="wrap">
    <div class="konf-content">
      <div class="intro">
        Kirby Konf is the first official conference for Kirby developers.
        A cosy single-day event, packed with interesting sessions and time to meet the team & community
      </div>

      <div class="section">
        <h2><del>Conference</del> Family gathering</h2>

        <div class="grid">
          <div class="column" style="--cols: 2">
            <?= $page->image('agency-1.jpg')->crop(900, 500) ?>
          </div>

          <div class="column text">
            <p>
              The Kirby community has always felt like a very friendly family and this event is our first family gathering.
            </p>
            <p>
              Inspired by the spirit of indie web camps, it's all about meeting other Kirby developers, sharing tips and tricks, learning and working together.
            </p>
            <p>With just 50 available tickets, we intentionally want to keep it small.</p>
          </div>

          <div class="column text">
            <p>
              <a href="https://3st-digital.de/"><b>3st digital</b></a> invited us to host the first Kirby Konf at their beautiful office and it couldn't be a better match for this concept.
            </p>
            <p>
              A 15 minute walk from the Mainz train station, the agency is located directly at the river Rhine with a beautiful view. The modernized warehouse offers unique, friendly spaces that invite to hang out and work together.
            </p>
          </div>
          <div class="column" style="--cols: 2">
            <?= $page->image('agency-2.jpg')->crop(900, 500) ?>
          </div>

          <div class="column" style="--cols: 2">
            <?= $page->image('mainz.jpg')->crop(900, 500) ?>
          </div>
          <div class="column text">
            <p>
              Mainz is the capital of Rhineland-Palatinate. Well known for its world-famous vineyards, beautiful landscapes and picturesque villages, this area in Southern Germany is definitely worth a visit and an extended stay.
            </p>
              Mainz is well connected via train, Autobahn and close to the Frankfurt Airport (FRA).
            </p>
            <p>
              <a href="https://www.google.com/maps/place/3st+digital+GmbH/@50.014884,8.262088,15z/data=!4m2!3m1!1s0x0:0xb4439e0a74d0c633?sa=X&ved=2ahUKEwjX_tHqh_TmAhUHT8AKHWaLArEQ_BIwDXoECAoQCA">Google Maps &rsaquo;</a>
            </p>
          </div>

        </div>
      </div>

    </div>
  </div>
  <div class="-background:light">
    <div class="wrap">
      <div class="konf-schedule">
        <div class="section">
          <h2>Schedule</h2>

          <div class="grid">
            <div class="column">
              <h3>Warm-up</h3>
              <div class="text">
                <p>
                  We are currently planning a warm-up event on Friday 20th before the conference. The warm-up will start at about 19:00.
                </p>
                <p>Please register for the warm-up when you get your ticket. The warm-up will be free, but we need to plan ahead how many people will attend.</p>
                <p>
                  We haven't found a venue for it yet. Stay tuned for updates!
                </p>
              </div>
            </div>
            <div class="column">
              <h3>Conference</h3>
              <div class="text">
                <p>
                  Registration: <br>09:00
                </p>
                <p>
                  Keynote by Bastian:<br>10:00
                </p>
                <p>
                  Morning Sessions:<br>11:00 - 13:00
                </p>
                <p>
                  Lunch:<br>13:00 - 14:30
                </p>
                <p>
                  Afternoon Sessions:<br>14:30 - 17:00
                </p>
                <p>
                  Next to our own sessions, we are currently collecting ideas for community-driven sessions. You are invited to <a href="https://github.com/getkirby/konf/issues">add your own ideas</a>!
                </p>
              </div>
            </div>
            <div class="column">
              <h3>After party</h3>
              <div class="text">
                <p>
                  We will keep it cosy for the after party. Let's have drinks at the venue together and then move out for dinner and explore Mainz.
                </p>
                <p>
                  There's no registration. <br>We keep this simple.
                </p>
              </div>
            </div>
          </div>

          <div id="tickets">
            <h2>Tickets</h2>
            <!-- place this in your head tag -->
            <script src='https://js.tito.io/v1' async></script>
            <link rel="stylesheet" type="text/css" href='https://css.tito.io/v1.1' />

            <!-- Place this where you want the widget to appear -->
            <tito-widget class="konf-tickets" event="getkirby/2020"></tito-widget>
          </div>
        </div>

      </div>
    </div>

  </div>

  <div class="wrap">
    <div class="section">

      <div class="grid">
        <div class="column" style="--cols: 2">
          <h2>Partners</h2>

          <div class="konf-partners">
            <a href="https://3st-digital.de/"><?= $page->image('3st.svg') ?></a>
            <a href="https://uberspace.de/en/"><?= $page->image('uberspace.svg') ?></a>
            <a href="https://beyondtellerrand.com/"><?= $page->image('beyondtellerrand.svg') ?></a>
          </div>

          <div class="text">
            <p>Do you want to become a partner? Please get in contact: <a href="mailto:mail@getkirby.com">mail@getkirby.com</a></p>
          </div>
        </div>
        <div class="column">
          <h2>Links</h2>
          <div class="text">
            <ul>
              <li><a href="<?= url('https://github.com/getkirby/konf/issues') ?>">Session planning</a></li>
              <li><a href="<?= url('konf/code-of-conduct') ?>">Code of conduct</a></li>
              <li><a href="<?= url('konf/terms') ?>">Terms</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<?php snippet('footer', ['theme' => 'dark']) ?>
