<?php snippet('header') ?>

  <main class="community-page | main" id="maincontent">

    <div class="wrap">

      <header class="community-page-hero hero">
        <h1><?= $page->title() ?></h1>
        <div class="intro -mb:medium">
          <?= $page->intro()->kt() ?>
          <p><a href="https://forum.getkirby.com">forum.getkirby.com</a></p>
        </div>
      </header>

    </div>

    <!-- # Plugins Showcase -->

    <section class="community-plugins-section -mb:huge">
      <div class="wrap">
        <div class="community-plugins-container">
          <header class="-mb:large">
            <h2 id="team" class="h2 -color:white"><?= $pluginsPage->title() ?></h2>
            <p class="intro -theme:dark">
              <?= $pluginsPage->intro() ?>
            </p>
          </header>

          <div class="community-plugins">
            <?php foreach($plugins as $item): ?>
            <article>
              <a href="<?= $item->repository() ?>">
                <figure class="screenshot -mb:medium">
                  <?php if ($image = $item->image()): ?>
                    <?= $image->html() ?>
                  <?php endif ?>
                </figure>

                <header>
                  <h3 class="h6 -mb:tiny -color:white"><?= $item->title() ?></h3>
                  <p class="-mb:small">by <?= $item->parent()->title()->h() ?></p>

                  <div class="text">
                    <?= $item->description()->kt() ?>
                  </div>
                </header>
              </a>
            </article>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </section>

    <div class="wrap">

      <!-- # Themes -->
      <div class="community-themes">

        <h2 id="themes" class="h2">Themes</h2>
        <div>
          <figure>
            <a href="https://getkirby-themes.com"><?= $themes->image() ?></a>
          </figure>
          <div class="intro -mb:medium">
            <?= $themes->intro()->kt() ?>
            <p><a href="https://getkirby-themes.com">getkirby-themes.com</a></p>
          </div>
        </div>
      </div>

      <!-- # Team Section -->
      <section class="community-team-section | section">

        <header class="-mb:large">
          <h2 id="team" class="h2">Team</h2>
          <p class="intro">
            Kirby grew from a one-man show to a team of dedicated developers, designers and writers.
          </p>
        </header>

        <ul class="community-mates | -mb:huge">
          <?php foreach ($mates as $mate): ?>
            <li class="community-mate">

              <figure class="-mb:small screenshot">
                <span class="intrinsic" style="padding-bottom: 100%">
                  <?= $mate->image()->html(['alt' => $mate->title()]) ?>
                </span>
              </figure>

              <h3 class="h5"><?= $mate->title() ?><br></h3>

              <p class="-mb:medium">
                <small><?= $mate->role() ?></small>
              </p>

              <ul class="community-mate-links">
                <?php if($mate->website()->isNotEmpty()): ?>
                <li>
                  <a href="<?= $mate->website() ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="nc-icon-wrapper" fill="#0d0f12"><path fill="#0d0f12" d="M8,0C3.6,0,0,3.6,0,8s3.6,8,8,8s8-3.6,8-8S12.4,0,8,0z M13.9,7H12c-0.1-1.5-0.4-2.9-0.8-4.1 C12.6,3.8,13.6,5.3,13.9,7z M8,14c-0.6,0-1.8-1.9-2-5H10C9.8,12.1,8.6,14,8,14z M6,7c0.2-3.1,1.3-5,2-5s1.8,1.9,2,5H6z M4.9,2.9 C4.4,4.1,4.1,5.5,4,7H2.1C2.4,5.3,3.4,3.8,4.9,2.9z M2.1,9H4c0.1,1.5,0.4,2.9,0.8,4.1C3.4,12.2,2.4,10.7,2.1,9z M11.1,13.1 c0.5-1.2,0.7-2.6,0.8-4.1h1.9C13.6,10.7,12.6,12.2,11.1,13.1z"></path></g></svg>
                  </a>
                </li>
                <?php endif ?>
                <?php if($mate->twitter()->isNotEmpty()): ?>
                <li>
                  <a href="https://twitter.com/<?= $mate->twitter() ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="nc-icon-wrapper" fill="#0d0f12"><path fill="#0d0f12" d="M16,3c-0.6,0.3-1.2,0.4-1.9,0.5c0.7-0.4,1.2-1,1.4-1.8c-0.6,0.4-1.3,0.6-2.1,0.8c-0.6-0.6-1.5-1-2.4-1 C9.3,1.5,7.8,3,7.8,4.8c0,0.3,0,0.5,0.1,0.7C5.2,5.4,2.7,4.1,1.1,2.1c-0.3,0.5-0.4,1-0.4,1.7c0,1.1,0.6,2.1,1.5,2.7 c-0.5,0-1-0.2-1.5-0.4c0,0,0,0,0,0c0,1.6,1.1,2.9,2.6,3.2C3,9.4,2.7,9.4,2.4,9.4c-0.2,0-0.4,0-0.6-0.1c0.4,1.3,1.6,2.3,3.1,2.3 c-1.1,0.9-2.5,1.4-4.1,1.4c-0.3,0-0.5,0-0.8,0c1.5,0.9,3.2,1.5,5,1.5c6,0,9.3-5,9.3-9.3c0-0.1,0-0.3,0-0.4C15,4.3,15.6,3.7,16,3z"></path></g></svg>
                  </a>
                </li>
                <?php endif ?>
                <?php if($mate->github()->isNotEmpty()): ?>
                <li>
                  <a href="https://github.com/<?= $mate->github() ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve" width="16" height="16"><g class="nc-icon-wrapper" fill="#0d0f12"><path fill-rule="evenodd" clip-rule="evenodd" fill="#0d0f12" d="M8,0.2c-4.4,0-8,3.6-8,8c0,3.5,2.3,6.5,5.5,7.6 C5.9,15.9,6,15.6,6,15.4c0-0.2,0-0.7,0-1.4C3.8,14.5,3.3,13,3.3,13c-0.4-0.9-0.9-1.2-0.9-1.2c-0.7-0.5,0.1-0.5,0.1-0.5 c0.8,0.1,1.2,0.8,1.2,0.8C4.4,13.4,5.6,13,6,12.8c0.1-0.5,0.3-0.9,0.5-1.1c-1.8-0.2-3.6-0.9-3.6-4c0-0.9,0.3-1.6,0.8-2.1 c-0.1-0.2-0.4-1,0.1-2.1c0,0,0.7-0.2,2.2,0.8c0.6-0.2,1.3-0.3,2-0.3c0.7,0,1.4,0.1,2,0.3c1.5-1,2.2-0.8,2.2-0.8 c0.4,1.1,0.2,1.9,0.1,2.1c0.5,0.6,0.8,1.3,0.8,2.1c0,3.1-1.9,3.7-3.7,3.9C9.7,12,10,12.5,10,13.2c0,1.1,0,1.9,0,2.2 c0,0.2,0.1,0.5,0.6,0.4c3.2-1.1,5.5-4.1,5.5-7.6C16,3.8,12.4,0.2,8,0.2z"></path></g></svg>
                  </a>
                </li>
                <?php endif ?>
              </ul>

            </li>
          <?php endforeach ?>
        </ul>

        <div class="community-contributors">
          <header class="-mb:large">
            <h2 id="contributors" class="h2">Our contributors</h2>
            <p class="intro">
              We are very lucky to have a really supportive group of developers and translators, who build plugins and help us test and plan new features for Kirby.
            </p>
          </header>
          <ul>
            <?php foreach ($page->find('contributors')->children()->listed()->shuffle() as $contributor): ?>
            <li>
              <a href="<?= $contributor->link() ?>" title="<?= $contributor->title() ?>" class="screenshot">
                <span class="intrinsic" style="padding-bottom: 100%">
                  <?= $contributor->image()->html(['alt' => $contributor->title()]) ?>
                </span>
              </a>
            </li>
            <?php endforeach ?>
          </ul>
        </div>

      </section>

    </div>

  </main>

<?php snippet('footer') ?>
