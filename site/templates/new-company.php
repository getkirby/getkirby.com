<?php layout() ?>

<style>
  .hero-text {
    margin-bottom: var(--spacing-12);
  }

  .hero-images {
    --columns: 3;
    display: grid;
    grid-template-columns: repeat(var(--columns), minmax(0, 1fr));
    grid-gap: var(--spacing-6);
    align-items: center;
  }

  .hero-images li {
    background: var(--color-yellow-300);
    border-radius: 3px;
  }

  .hero-images figure {
    border-radius: 3px;
    object-fit: cover;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
  }

  .hero-images img {
    border-radius: 3px 3px 0 0;
    aspect-ratio: 5/6;
    filter: grayscale(1);
    object-fit: cover;
    mix-blend-mode: multiply;
  }

  .hero-images figcaption {
    font-family: var(--font-mono);
    white-space: nowrap;
    font-size: var(--text-xs);
    padding: var(--spacing-2);
    background: var(--color-white);
    color: var(--color-black);
  }

  .hero-images figcaption span {
    display: none;
  }

  @media screen and (min-width: 42rem) {
    .hero-images {
      --columns: 5;
    }
  }

  @media screen and (min-width: 52rem) {
    .hero-images figcaption span {
      display: inline;
    }
  }

  @media screen and (min-width: 80rem) {
    .hero {
      display: grid;
      grid-gap: var(--spacing-24);
      grid-template-columns: 1fr 2fr;
    }

    .hero-text {
      margin-bottom: 0;
    }

    .hero-images figcaption span {
      display: none;
    }
  }

  @media screen and (min-width: 90rem) {
    .hero-images figcaption span {
      display: inline;
    }
  }


  mark {
    background: var(--color-yellow-300);
  }

  .checkbox {
    position: relative;
    display: flex;
    align-items: center;
    border: 2px solid var(--color-black);
    padding: var(--spacing-2) var(--spacing-3) var(--spacing-2) var(--spacing-10);
    margin-bottom: var(--spacing-6);
    cursor: pointer;
    border-radius: var(--rounded);
  }
  .checkbox input {
    position: absolute;
    left: var(--spacing-3);
    top: var(--spacing-3);
  }

  .error {
    background: var(--color-red-400);
    padding: var(--spacing-6) var(--spacing-12);
    font-weight: var(--font-bold);
    border-radius: var(--rounded);
    margin-bottom: var(--spacing-3);
    line-height: var(--leading-tight);
  }

  .error ul {
    list-style: disc;
  }

  .form-boxes {
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: 1px;
  }

  .form-boxes[data-span="true"] {
    box-shadow: var(--shadow-xl);
    background: var(--color-light);
  }

  .form-boxes[data-span="true"] .form-box {
    box-shadow: none;
  }

  .form-box {
    padding: var(--spacing-6);
    background: var(--color-light);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .form-box[data-active="true"] {
    background: var(--color-white);
    box-shadow: var(--shadow-xl);
    z-index: 1;
  }

  .form-box footer .columns {
    --columns: 1;
  }

  .form-box-data {
    display: grid;
    grid-template-columns: 1fr;
    grid-gap: var(--spacing-12);
  }

  .form-account strong {
    display: none;
  }

  .note {
    background: var(--color-yellow-300);
    padding: var(--spacing-6) var(--spacing-12);
    margin-bottom: 1px;
  }

  .note br {
    display: none;
  }

  @media screen and (min-width: 60rem) {
    .form-boxes {
      grid-template-columns: 2fr 1fr;
    }

    .form-box-data {
      grid-template-columns: 1fr 1fr;
    }

    .form-box-data footer {
      grid-column: 1 / span 2;
    }

    .form-box {
      padding: var(--spacing-12);
    }

    .form-box footer .columns {
      --columns: 2;
      --gap: var(--spacing-12);
    }

    .form-account strong {
      display: block;
    }
  }

  @media screen and (min-width: 80rem) {
    .note br {
      display: block;
    }
  }
</style>

<article>
  <!-- Header & team photos -->
  <header class="mb-24 hero h1">
    <div class="hero-text">
      <h1>Our new team company</h1>
    </div>
    <ul class="hero-images">
      <li>
        <figure>
          <?= image('bastian.jpg')->crop(250, 300) ?>
          <figcaption>Bastian <span>Allgeier</span></figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <?= image('sonja.jpg')->crop(250, 300) ?>
          <figcaption>Sonja <span>Broda</span></figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <?= image('lukas.jpg')->crop(250, 300) ?>
          <figcaption>Lukas <span>Bestle</span></figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <?= image('nico.jpg')->crop(250, 300) ?>
          <figcaption>Nico <span>Hoffmann</span></figcaption>
        </figure>
      </li>
      <li>
        <figure>
          <?= image('ahmet.png')->crop(250, 300) ?>
          <figcaption>Ahmet <span>Bora</span></figcaption>
        </figure>
      </li>
    </ul>
  </header>

  <?php if (get('thank') === 'you') : ?>
    <?php snippet('templates/new-company/thank-you') ?>
  <?php else : ?>
    <?php snippet('templates/new-company/intro') ?>

    <?php if ($email) : ?>
      <?php snippet('templates/new-company/authenticated') ?>
    <?php else : ?>
      <?php snippet('templates/new-company/unauthenticated') ?>
    <?php endif ?>

    <section class="mb-42">
      <h2 class="h2 mb-6">Frequently asked questions</h2>
      <?php snippet('faq', ['questions' => $page->find('answers')->children()]) ?>
    </section>

  <?php endif ?>

</article>
