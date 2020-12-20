<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kirby 3.5 is here 🚀</title>

  <?= css('assets/lightbox/lightbox.css') ?>
  <?= css('assets/css/index.css') ?>
  <?= css('assets/css/v35.css') ?>
  <?= js('assets/js/index.js', ['defer' => true]) ?>
</head>
<body class="v35">

  <header class="v35-hero v35-section bg-black">
    <div class="v35-container">
      <?php snippet('logo') ?>
      <h1>3.5</h1>
      <a class="btn" href="<?= url('try') ?>">
        <?php icon('download') ?>
        Try 3.5 now
      </a>
    </div>
  </header>

  <main>
    <section class="v35-section bg-light">
      <div class="v35-container">
        <div class="grid">
          <article class="column" style="--columns: 6">
            <header class="mb-6">
              <h2 class="text-2xl">Builder + Editor = Blocks</h2>
              <p class="text-2xl color-gray">A match made in heaven</p>
            </header>
            <div class="text text-lg mb-12">
              <p>Our brand new Blocks field is the perfect solution for complex single-column layouts and long-form text.</p>
              <p>It brings the best of the <a href="https://github.com/getkirby/editor">Editor</a> and the <a href="https://github.com/TimOetting/kirby-builder">Builder</a> plugins into the core. Combining a great WYSIWYG editing experience with fully customizable blocks.</p>
            </div>
            <aside class="mb-12">
              <h3 class="text-xl mb-3">Highlights</h3>
              <?php snippet('v35/gallery', [
                'images' => ['blocks-selector', 'blocks-settings', 'blocks-plugins']
              ]) ?>
            </aside>
            <p><a class="btn-link" href="<?= url('docs/reference/panel/fields/blocks') ?>">Learn more</a></p>
          </article>
          <figure class="column" style="--columns: 6">
            <a href="<?= url('docs/reference/panel/fields/blocks') ?>">
              <?php if ($image = $page->image('blocks.jpg')): ?>
              <img
                loading="lazy"
                src="<?= $image->resize(700)->url() ?>"
                srcset="<?= $image->srcset([
                  700 => '1x',
                  1400 => '2x'
                ]) ?>"
                alt="The new blocks field"
              >
              <?php endif ?>
            </a>
          </figure>
        </div>
      </div>
    </section>

    <section class="v35-section">
      <div class="v35-container">
        <div class="grid">
          <figure class="column" style="--columns: 6">
            <a href="<?= url('docs/reference/panel/fields/layout') ?>">
              <?php if ($image = $page->image('layouts.jpg')): ?>
              <img
                loading="lazy"
                class="shadow"
                src="<?= $image->resize(700)->url() ?>"
                srcset="<?= $image->srcset([
                  700 => '1x',
                  1400 => '2x'
                ]) ?>"
                alt="The new layouts field"
              >
              <?php endif ?>
            </a>
          </figure>
          <article class="column" style="--columns: 6">
            <header class="mb-6">
              <h2 class="text-2xl">Layout</h2>
              <p class="text-2xl color-gray">Yes you can</p>
            </header>
            <div class="text text-lg mb-12">
              <p>Together with the new Blocks field we are also introducing a powerful new Layout field. Arrange blocks in multiple columns and build complex page layouts. Assign custom layout settings and fine-tune the generated HTML in your templates.</p>
            </div>
            <aside class="mb-12">
              <h3 class="text-xl mb-3">Highlights</h3>
              <?php snippet('v35/gallery', [
                'images' => ['layout-blocks', 'layout-selector', 'layout-settings']
              ]) ?>
            </aside>
            <p><a class="btn-link" href="<?= url('docs/reference/panel/fields/layout') ?>">Learn more</a></p>
          </article>
        </div>
      </div>
    </section>

    <section class="v35-auth v35-section bg-black">
      <div class="v35-container">
        <h2 class="text-2xl">Authentication</h2>

        <div class="grid">
          <article class="column" style="--columns: 4">
            <header>
              <h3 class="text-2xl mb-6" style="color: var(--color-code-green)">Passwordless login</h3>
            </header>
            <div class="text text-lg">
              <p>3.5 comes with major enhancements for your login flow. Enable password-less login for secure, one-time code authentication.</p>
              <?php snippet('v35/image', [
                'image' => $page->image('login-passwordless.jpg')
              ]) ?>
              <?php snippet('v35/image', [
                'image' => $page->image('login-code.jpg')
              ]) ?>
              <p><a class="btn-link" href="<?= url('docs/guide/authentication/login-methods') ?>">Learn more</a></p>
            </div>
          </article>

          <article class="column" style="--columns: 4">
            <header>
              <h3 class="text-2xl mb-6" style="color: var(--color-code-purple)">Password reset</h3>
            </header>
            <div class="text text-lg">
              <p>The new authentication enhancements now offer a secure way for your users to reset their passwords.</p>
              <?php snippet('v35/image', [
                'image' => $page->image('password-reset-email.jpg')
              ]) ?>
              <?php snippet('v35/image', [
                'image' => $page->image('password-reset-code.jpg')
              ]) ?>
              <?php snippet('v35/image', [
                'image' => $page->image('password-reset.jpg')
              ]) ?>
              <p><a class="btn-link" href="<?= url('docs/guide/authentication/password-reset-form') ?>">Learn more</a></p>
            </div>
          </article>

          <article class="column" style="--columns: 4">
            <header>
              <h3 class="text-2xl mb-6" style="color: var(--color-code-aqua)">2FA</h3>
            </header>
            <div class="text text-lg">
              <p>Secure standard password-based authentication with an additional one-time code verification layer for increased security.</p>
              <?php snippet('v35/image', [
                'image' => $page->image('login.jpg')
              ]) ?>
              <?php snippet('v35/image', [
                'image' => $page->image('login-code.jpg')
              ]) ?>
              <p><a class="btn-link" href="<?= url('docs/guide/authentication/frontend-login') ?>">Learn more</a></p>
            </div>
          </article>

        </div>
      </div>
    </section>

    <section class="v35-features v35-section">
      <div class="v35-container">
        <?php snippet('v35/feature', [
          'headline' => 'Date & Time',
          'image' => $page->image('date.jpg'),
          'text' => 'The new date and time fields are a joy to work with and open completely new ways to enter dates with custom date formats and intervals.',
          'link' => 'docs/reference/panel/fields/date'
        ]) ?>

        <?php snippet('v35/feature', [
          'headline' => 'Quicksearch',
          'image' => $page->image('search.jpg'),
          'text' => 'The Panel search has been redesigned and now shows nice previews for pages, files and users.'
        ]) ?>

        <?php snippet('v35/feature', [
          'headline' => 'Writer field',
          'image' => $page->image('writer.jpg'),
          'text' => 'You don’t need the full power of the Blocks? Maybe just some inline HTML? Then the new Writer field is here for you. Create single-line HTML with formats like bold, italic, underline or links.',
          'link' => 'docs/reference/panel/fields/writer'
        ]) ?>

        <?php snippet('v35/feature', [
          'headline' => 'List field',
          'image' => $page->image('list.jpg'),
          'text' => 'The new list field can be used if you want to create simple ordered or unordered lists in a more visual way than with Markdown.',
          'link' => 'docs/reference/panel/fields/list'
        ]) ?>

        <?php snippet('v35/feature', [
          'headline' => 'Title & URL',
          'image' => $page->image('unified-dialog.jpg'),
          'text' => 'Changing the page title or the page URL is now done in the same dialog. With this simplified workflow you can instantly see when your page title and slug no longer match and should be updated.'
        ]) ?>

        <?php snippet('v35/feature', [
          'headline' => 'Status icons',
          'image' => $page->image('status-icons.jpg'),
          'text' => 'Kirby\'s page status icons now have distinctive forms to make them accessible for people with color blindness.'
        ]) ?>

        <?php snippet('v35/feature', [
          'headline' => 'New starterkit',
          'image' => $page->image('starterkit.jpg'),
          'class' => 'shadow',
          'text' => 'We completely overhauled Kirby’s Starterkit to feature a new design together with the new blocks and layout fields.',
          'link' => 'https://github.com/getkirby/starterkit'
        ]) ?>
      </div>
    </section>

    <section class="v35-fine-print v35-section bg-light">
      <div class="v35-container">
        <h2 class="text-2xl mb-12">The fine print</h2>
        <div class="grid">
          <article class="column" style="--columns: 4">
            <h3 class="mb-3">More new features</h3>
            <div class="text">
              <?= $page->features()->kt() ?>
            </div>
          </article>
          <article class="column" style="--columns: 4">
            <h3 class="mb-3">Enhancements</h3>
            <div class="text">
              <?= $page->enhancements()->kt() ?>
            </div>
          </article>
          <article class="column" style="--columns: 4">
            <h3 class="mb-3">Bug fixes</h3>
            <div class="text">
              <?= $page->bugs()->kt() ?>
            </div>
          </article>
          <article class="column" style="--columns: 12">
            <h3 class="mb-3">Breaking changes</h3>
            <div class="grid">
              <div class="column text" style="--columns: 6">
                <?= $page->breaking()->kt() ?>
              </div>
              <div class="column text" style="--columns: 6">
                <?= $page->deprecated()->kt() ?>
              </div>
            </div>
          </article>
          <article class="column" style="--columns: 6">
            <h3 class="mb-3">Stats</h3>
            <div class="text">
              <?= $page->stats()->kt() ?>
            </div>
          </article>
          <article class="column" style="--columns: 6">
            <h3 class="mb-3">Thank you</h3>
            <div class="text">
              <?= $page->thanks()->kt() ?>
            </div>
          </article>
        </div>
      </div>
    </section>

  </main>

  <footer class="v35-footer v35-section bg-black">
    <div class="v35-container">

      <p class="v35-kirby color-gray-400 text-lg">
        <a href="<?= url() ?>"><strong>Kirby:</strong> the file-based CMS that adapts to any project, loved by developers and editors alike</a>
      </p>

      <div class="v35-footer-cta">
        <nav class="v35-buttons">
          <a class="btn" href="<?= url('try') ?>">
            <?php icon('download') ?>
            Try
          </a>
          <span>&rsaquo;</span>
          <a class="btn" href="<?= url('love') ?>">
            <?php icon('love') ?>
            Love
          </a>
          <span>&rsaquo;</span>
          <a class="btn" href="<?= url('buy') ?>">
            <?php icon('cart') ?>
            Buy
          </a>
        </nav>

        <nav class="v35-social">
          <a href="https://twitter.com/getkirby"><?= icon('twitter') ?></a>
          <a href="https://chat.getkirby.com"><?= icon('discord') ?></a>
          <a href="https://instagram.com/getkirby"><?= icon('instagram') ?></a>
          <a href="https://github.com/getkirby"><?= icon('github') ?></a>
        </nav>
      </div>
    </div>
  </footer>

  <?= js('assets/lightbox/lightbox.js') ?>

  <script>
  // Lightbox
  Array.from(document.querySelectorAll("[data-lightbox]")).forEach(element => {
    element.onclick = (e) => {
      e.preventDefault();
      basicLightbox.create(`<img loading="lazy" src="${element.href}">`).show();
    };
  });
  </script>

</body>
</html>
