<!DOCTYPE html>
<html lang="en">
<head>
  <?php snippet('layouts/head') ?>
<style>

    .plugins {
      --min: 15rem;
    }

    .plugins li {
      padding-top: var(--spacing-2);
      min-width: 0;
      overflow: hidden;
      grid-gap: var(--spacing-3);
    }
    .plugins li > * {
      min-width: 0;
    }

    @media screen and (max-width: 40rem) {
      .plugins li > .iconbox {
        --size: 2rem;
        margin-top: var(--spacing-1);
      }
      .plugins li {
        grid-template-columns: 4rem 1fr;
      }
      .plugins li nav {
        grid-row: 1;
        grid-column: 2;
        justify-self: flex-end;
      }
      .plugins li a {
        grid-row: 2;
        grid-column: span 2;
      }
    }

    @media screen and (min-width: 40rem) {
      .plugins {
        --min: 18rem;
      }
      .plugins li > .iconbox {
        --size: 4rem;
        margin-top: var(--spacing-1);
      }
      .plugins {
        grid-auto-rows: 1fr;
      }
      .plugins li {
        grid-template-columns: 4rem 1fr auto;
      }
    }

  </style>

</head>
<body>
  <?php snippet('layouts/header') ?>
  <main id="main" class="main">
    <div class="container">
      <div class="with-sidebar">
        <article class="mb-24">
          <?php slot() ?>
          <?php endslot() ?>
        </article>
        <?php snippet('templates/plugins/sidebar') ?>
      </div>
    </div>
  </main>
  <?php snippet('layouts/footer') ?>
</body>
</html>
