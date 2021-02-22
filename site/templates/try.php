<?php snippet('header') ?>

<main class="try-page | main" id="maincontent">
  <article class="wrap">

    <?php if ($statusType && $statusMessage): ?>
    <div aria-labelledby="try-status-label" class="status -type:<?= $statusType ?>">
      <?= icon(r($statusType === 'status', 'check', 'warning'), true) ?>
      <p class="screen-reader-text" id="try-status-label"><strong><?= r($statusType === 'status', 'Status', 'Error') ?>:</strong></p>
      <p><?= widont($statusMessage) ?></p>
    </div>
    <?php endif ?>

    <header class="hero">
      <h1>Try Kirby for free</h1>
      <div class="intro">
        <?= $page->intro()->kt() ?>
      </div>
    </header>

    <div class="grid" style="--gutter: 3rem">
      <div class="column box" style="--columns: 8">
        <form class="demo" action="https://<?= r(param('demo') === 'staging', 'staging.') ?>trykirby.com" method="POST">
          <h2 class="h3">Personal Demo</h2>
          <figure>
            <button class="button-reset">
              <?php if($image = $page->image('interface.jpg')): ?>
              <img
                src="<?= $image->resize(800)->url() ?>"
                srcset="<?= $image->srcset([
                  800 => '1x',
                  1600 => '2x'
                ]) ?>"
                alt="The dashboard of the Panel in our online demo"
              />
              <?php endif ?>
            </button>
          </figure>

          <div class="grid -mb:medium">
            <div class="column text" style="--columns: 6">
              <p>You are one click away from your personal demo. Give Kirby a spin and explore the Panel and our six example projects.</p>
            </div>
            <div class="column text" style="--columns: 6">
              <p>Questions? Please let us know: <a href="mailto:support@getkirby.com">support@getkirby.com</a></p>
            </div>
          </div>
          <p>
            <?= snippet('cta', [
              'text'   => 'Start the demo',
              'icon'   => 'panel',
              'button' => true
            ]) ?>
          </p>
        </form>
      </div>
      <div class="column local" style="--columns: 4">
        <h2 class="h3">Kirby on your computer</h2>
        <div class="text -mb:medium">
          <p>
            You can install Kirby on your computer or a test server and evaluate it as long as you need.<br>
            <a href="<?= url('docs/guide/quickstart') ?>">Get up and running …</a>
          </p>
        </div>

        <div class="kit">
          <p class="text -mb:medium">
            <strong>Starterkit</strong><br>
            Fully annotated example site – for everyone who wants to explore Kirby's capabilities.
          </p>
          <p>
            <?= snippet('cta', [
              'text' => 'Download',
              'icon' => 'download',
              'link' => 'https://github.com/getkirby/starterkit/archive/main.zip'
            ]) ?>
          </p>
        </div>

        <div class="kit -mb:large">
          <p class="text -mb:medium">
            <strong>Plainkit</strong><br>
            Start from scratch. No templates, no content, no styles – just you, Kirby and your imagination.<br>
          </p>
          <p>
            <?= snippet('cta', [
              'text' => 'Download',
              'icon' => 'download',
              'link' => 'https://github.com/getkirby/plainkit/archive/main.zip'
            ]) ?>
          </p>
        </div>
      </div>
    </div>


  </article>
</main>

<?php snippet('footer') ?>
