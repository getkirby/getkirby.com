<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kirby 3.5 is here 🚀</title>

  <?= css('assets/css/index.css') ?>

  <style>
    html {
      background: #fff;
    }

    .bg-black {
      background: #000;
      color: #fff;
    }

    .bg-light {
      background: #efefef;
    }


    .v35-hero h1 {
      font-weight: 400;
      font-size: 4rem;
      margin: 0 auto;
    }

    .v35-section {
      padding: 0 1.5rem;
    }

    .v35-section-hero {
      margin-bottom: 1.5rem;
      font-size: 2rem;
    }
    .v35-section-hero h2 {
      margin-bottom: 0;
      font-weight: 400;
      font-size: inherit;
    }
    .v35-section-hero p {
      font-weight: 400;
      color: #777;
      font-size: inherit;
    }
    .v35-section-body {
      font-size: 1.25rem;
      max-width: 30rem;
      margin: 0 auto;
    }
    .v35-section-body .text {
      margin-bottom: 3rem;
    }

    .v35-grid {
      display: flex;
      align-items: stretch;
      justify-content: center;
    }
    .v35-grid > * {
      display: flex;
      align-items: center;
      padding: 3rem;
      flex-basis: 50%;
      flex-grow: 1;
    }

    .shadow {
      box-shadow: rgba(0,0,0,.2) 0 2px 5px, rgba(0,0,0,.1) 0 4px 15px;
    }

    .v35-section h3 {
      font-size: 1rem;
      margin-bottom: .75rem;
    }

    .v35-gallery {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: .75rem;
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

  </style>

</head>
<body>

  <header class="v35-section v35-hero bg-black">
    <div class="v35-grid">
      <div>
        <h1>3.5</h1>
      </div>
    </div>
  </header>

  <section class="v35-section bg-light">
    <div class="v35-grid">
      <div>
        <article class="v35-section-body">
          <header class="v35-section-hero">
            <h2 class="h1">Builder + Editor = Blocks</h2>
            <p class="h1">A match made in heaven</p>
          </header>
          <div class="text">
            <p>The Kirby Builder by Tim Ötting is one of the most popular plugins out there and together with Tim we decided to add it to the core 🎉</p>
            <p>We've rewritten it from scratch and merged it with our popular Editor plugin. The new field is called Blocks and will eventually replace both plugins.</p>
          </div>

          <aside>
            <h3>Features</h3>

            <ul class="v35-gallery">
              <li>
                <a href="">
                  <figure>
                    <span><?= $page->image('blocks-selector.png') ?></span>
                    <figcaption>Blocks galore</figcaption>
                  </figure>
                </a>
              </li>
              <li>
                <a href="">
                  <figure>
                    <span><?= $page->image('layout-settings.png') ?></span>
                    <figcaption>Block settings</figcaption>
                  </figure>
                </a>
              </li>
              <li>
                <a href="">
                  <figure>
                    <span><?= $page->image('layout-settings.png') ?></span>
                    <figcaption>Perfect HTML</figcaption>
                  </figure>
                </a>
              </li>
            </ul>
          </aside>

        </article>
      </div>

      <div>
        <?= $page->image('blocks.png') ?>
      </div>
    </div>
  </section>

  <section class="v35-section">
    <div class="v35-grid">
      <div class="bottom-left">
        <?= $page->image('layouts.png')->html(['class' => 'shadow']) ?>
      </div>

      <div>
        <article class="v35-section-body">
          <header class="v35-section-hero">
            <h2 class="h1">Layout</h2>
            <p class="h1">Yes you can</p>
          </header>
          <div class="text">
            <p>Together with the new Blocks field we are also introducing a powerful new Layout field. Arrange blocks in multiple columns and build complex page layouts. Assign custom layout settings and fine-tune the generated HTML in your templates.</p>
          </div>

          <aside>
            <h3>Features</h3>

            <ul class="v35-gallery">
              <li>
                <a href="">
                  <figure>
                    <span><?= $page->image('layout-selector.png') ?></span>
                    <figcaption>Configurable layouts</figcaption>
                  </figure>
                </a>
              </li>
              <li>
                <a href="">
                  <figure>
                    <span><?= $page->image('layout-settings.png') ?></span>
                    <figcaption>Layout settings</figcaption>
                  </figure>
                </a>
              </li>
            </ul>
          </aside>

        </article>
      </div>

    </div>
  </section>


</body>
</html>
