<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kirby 3.5 is here 🚀</title>

  <?= css('assets/lightbox/lightbox.css') ?>
  <?= css('assets/css/index.css') ?>

  <?= js('assets/js/index.js', ['defer' => true]) ?>

  <style>
    html {
      background: #fff;
    }

    img {
      max-width: 100%;
      width: 100%;
    }

    :root {
      --color-gray-400: #999;
      --color-gray-500: #777;
      --color-code-red:         #d16464;
      --color-code-orange:      #de935f;
      --color-code-yellow:      #f0c674;
      --color-code-green:       #a7bd68;
      --color-code-aqua:        #8abeb7;
      --color-code-blue:        #7e9abf;
      --color-code-purple:      #b294bb;
      --font-mono: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace;
      --padding: 1.5rem;
    }

    .v35-hero {
      position: relative;
      display: flex;
      align-items: end;
      justify-content: flex-start;
      height: 18rem;
      overflow: hidden;
    }
    .v35-hero .logo {
      position: absolute;
      top: 0;
      margin: 1.5rem;
      margin-left: var(--padding);
      left: 0;
    }
    .v35-hero h1 {
      position: absolute;
      bottom: -3rem;
      left: var(--padding);
      font-weight: 800;
      font-size: 14rem;
      margin: 0;
      margin-left: -.25rem;
      color: #000;
      background: linear-gradient(45deg,var(--color-code-aqua),var(--color-code-green),var(--color-code-orange));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .btn {
      display: inline-flex;
      padding: .5rem 1.5rem;
      align-items: center;
      font-size: .875rem;
      border: 2px solid currentColor;
      font-family: var(--font-mono);
    }
    .btn:hover {
      background: #fff;
      color: #000;
    }
    .btn svg {
      margin-right: .75rem;
    }

    .v35 .btn-link {
      display: inline-flex;
      text-decoration: none;
      font-weight: 500;
      border-bottom: 2px solid currentColor;
    }
    .v35 .btn-link::after {
      content: "›";
      padding-left: .5rem;
      color: var(--color-gray-400);
    }

    .v35-hero .btn {
      position: absolute;
      right: var(--padding);
      bottom: 2rem;
    }

    .v35-section {
      padding: var(--padding);
      overflow: hidden;
    }

    .v35-section-hero {
      margin-bottom: 1.5rem;
      font-size: 2rem;
    }

    main h1, main h2, main h3 {
      font-weight: 400;
      margin: 0;
    }

    .v35-gallery {
      display: grid;
      grid-gap: .75rem;
      grid-template-columns: repeat(auto-fit, minmax(8rem, .33fr));
    }
    .v35-gallery span {
      display: block;
      position: relative;
      padding-bottom: 100%;
      background: #000;
    }
    .v35-gallery span img {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      opacity: .5;
    }
    .v35-gallery figcaption {
      font-size: .875rem;
      padding-top: .5rem;
    }

    .color-gray {
      color: #777;
    }
    .color-gray-400 {
      color: var(--color-gray-400);
    }
    .color-gray-500 {
      color: var(--color-gray-500);
    }
    .bg-black {
      background: #000;
      color: #fff;
    }
    .bg-light {
      background: #efefef;
    }
    .grid {
      --columns: 12;
      --gutter: var(--padding);
      display: grid;
      grid-gap: var(--gutter);
      grid-template-columns: 1fr;
    }
    .grid > .column {
      margin-bottom: var(--gutter);
    }
    .mb-3 {
      margin-bottom: .75rem;
    }
    .mb-6 {
      margin-bottom: 1.5rem;
    }
    .mb-12 {
      margin-bottom: 3rem;
    }
    .mt-6 {
      margin-top: 1.5rem;
    }
    .shadow {
      box-shadow: rgba(0,0,0,.2) 0 2px 5px, rgba(0,0,0,.1) 0 4px 15px;
    }
    .text-lg {
      font-size: 1.125rem;
    }
    .text-xl {
      font-size: 1.5rem;
    }
    .text-2xl {
      font-size: 2rem;
      line-height: 1.175em;
    }

    @media screen and (min-width: 60rem) {
      :root {
        --padding: 3rem;
      }
      .grid {
        grid-template-columns: repeat(12, 1fr);
      }
      .grid > .column {
        grid-column: span var(--columns);
        margin-bottom: 0;
      }
    }

    @media screen and (min-width: 75rem) {
      :root {
        --padding: 4.5rem;
      }
    }

    @media screen and (min-width: 90rem) {
      :root {
        --padding: 6rem;
      }
    }

  </style>

</head>
<body class="v35">

  <header class="v35-hero bg-black">
    <?php snippet('logo') ?>
    <h1>3.5</h1>
    <a class="btn" href="<?= url('try') ?>">
      <?php icon('download') ?>
      Try 3.5 now
    </a>
  </header>

  <main>

    <section class="v35-section bg-light">
      <div class="grid">
        <article class="column" style="--columns: 6">
          <header class="mb-6">
            <h2 class="text-2xl">Builder + Editor = Blocks</h2>
            <p class="text-2xl color-gray">A match made in heaven</p>
          </header>
          <div class="text text-lg mb-12">
            <p>The Kirby Builder by Tim Ötting is one of the most popular plugins out there and together with Tim we decided to add it to the core 🎉</p>
            <p>We've rewritten it from scratch and merged it with our popular Editor plugin. The new field is called Blocks and will eventually replace both plugins.</p>
          </div>
          <aside class="mb-12">
            <h3 class="text-xl mb-3">Features</h3>
            <?php snippet('v35/gallery', [
              'images' => $page->images()->find('blocks-selector.png', 'layout-settings.png', 'layout-selector.png')
            ]) ?>
          </aside>
          <p><a class="btn-link" href="">Learn more</a></p>
        </article>
        <div class="column" style="--columns: 6">
          <?= $page->image('blocks.png') ?>
        </div>
      </div>
    </section>

    <section class="v35-section">
      <div class="grid">
        <div class="column" style="--columns: 6">
          <?= $page->image('layouts.png')->html(['class' => 'shadow']) ?>
        </div>
        <article class="column" style="--columns: 6">
          <header class="mb-6">
            <h2 class="text-2xl">Layout</h2>
            <p class="text-2xl color-gray">Yes you can</p>
          </header>
          <div class="text text-lg mb-12">
            <p>Together with the new Blocks field we are also introducing a powerful new Layout field. Arrange blocks in multiple columns and build complex page layouts. Assign custom layout settings and fine-tune the generated HTML in your templates.</p>
          </div>
          <aside class="mb-12">
            <h3 class="text-xl mb-3">Features</h3>
            <?php snippet('v35/gallery', [
              'images' => $page->images()->find('layout-selector.png', 'layout-settings.png', 'blocks-selector.png')
            ]) ?>
          </aside>
          <p><a class="btn-link" href="">Learn more</a></p>
        </article>
      </div>
    </section>

    <section class="v35-section bg-black">
      <h2 class="text-2xl">Authentication</h2>

      <div class="grid">
        <article class="column" style="--columns: 4">
          <header>
            <h3 class="text-2xl mb-6" style="color: var(--color-code-green)">Passwordless login</h3>
          </header>
          <div class="text text-lg">
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
            <?php snippet('v35/image', [
              'image' => $page->image('login.png')
            ]) ?>
            <p><a class="btn-link" href="">Learn more</a></p>
          </div>
        </article>
        <article class="column" style="--columns: 4">
          <header>
            <h3 class="text-2xl mb-6" style="color: var(--color-code-aqua)">2FA</h3>
          </header>
          <div class="text text-lg">
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
            <?php snippet('v35/image', [
              'image' => $page->image('login.png')
            ]) ?>
            <p><a class="btn-link" href="">Learn more</a></p>
          </div>
        </article>
        <article class="column" style="--columns: 4">
          <header>
            <h3 class="text-2xl mb-6" style="color: var(--color-code-purple)">Password reset</h3>
          </header>
          <div class="text text-lg">
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
            <?php snippet('v35/image', [
              'image' => $page->image('login.png')
            ]) ?>
            <p><a class="btn-link" href="">Learn more</a></p>
          </div>
        </article>
      </div>
    </section>

    <section class="v35-section bg-light">
      <article>
        <header class="mb-12">
          <h2 class="text-2xl">Date & Time</h2>
          <p class="text-2xl color-gray">Revisited</p>
        </header>
        <div class="grid">
          <div class="column" style="--columns: 4">
            <?php snippet('v35/image', [
              'image' => $page->image('date.png')
            ]) ?>
          </div>
          <div class="column text text-lg mt-6" style="--columns: 4">
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
            <p><a class="btn-link" href="">Learn more</a></p>
          </div>
          <div class="column text text-lg mt-6" style="--columns: 4">
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
            <p><a class="btn-link" href="">Learn more</a></p>
          </div>
        </div>
      </article>
    </section>

  </main>

  <footer class="bg-black v35-section">

    <a class="btn" href="<?= url('try') ?>">
      <?php icon('download') ?>
      Try 3.5 now
    </a>

  </footer>

  <?= js('assets/lightbox/lightbox.js') ?>

  <script>
  // Lightbox
  Array.from(document.querySelectorAll("[data-lightbox]")).forEach(element => {
    element.onclick = (e) => {
      e.preventDefault();
      basicLightbox.create(`<img src="${element.href}">`).show();
    };
  });
  </script>

</body>
</html>
