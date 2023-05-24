<?php layout() ?>

<style>
  .packages {
    overflow-x: scroll;
  }

  .packages table {
    table-layout: fixed;
  }

  .packages td,
  .packages th {
    padding: 0.5rem 0;
    vertical-align: baseline;
    font-variant-numeric: tabular-nums;
  }

  .packages th {
    min-width: 10rem;
    max-width: 22rem;
    padding-right: 1.5rem;
  }

  .packages thead th,
  .packages tbody td {
    z-index: 1;
    border-bottom: 1px solid var(--color-light);
    background: var(--color-white);
    padding: 0.5rem 1.5rem;
    box-shadow: var(--shadow-lg);
    text-align: center;
    vertical-align: middle;
  }

  .packages tr:last-child > td {
    border-bottom: 0 !important;
  }

  .packages tbody th {
    border-top: 1px solid transparent;
    font-weight: var(--font-normal);
    font-size: var(--text-sm);
    line-height: var(--leading-snug);
  }

  .packages tbody th small {
    color: var(--color-gray-700);
    display: block;
    font-size: inherit;
  }

  .packages tr > :first-child {
    width: 20rem;
  }

  .packages .plus {
    color: var(--color-purple-700);
  }

  .packages .empty {
    color: var(--color-gray-400)
  }

  .packages tfoot td {
    padding: 3rem 1.5rem;
    box-shadow: none;
    background: none;
    vertical-align: middle;
    text-align: center;
  }

  .packages tfoot td .btn {
    width: 100%;
  }

  @media (max-width: 54rem) {
    .packages tr > :first-child {
      width: 12rem;
    }
    .packages tr > :not(:first-child) {
      width: 5rem;
    }
  }
  @media (max-width: 65rem) {
    .packages tfoot td {
      padding-inline: .25rem;
    }
    .packages tfoot .btn {
      height: 100%;
      white-space: normal;
    }
    .packages tfoot .btn svg {
      display: none;
    }
  }
</style>

<article>

  <header class="mb-24">
    <h1 class="h1 mb-6">Join the Kirby partner network</h1>
    <p class="text-xl leading-snug color-gray-700 max-w-xl">
      The Kirby partner network is the perfect place to increase your exposure and show proven credibility. Demonstrate your Kirby and web development expertise to a large, growing audience. Get in touch with clients from all over the world, and find new leads.
    </p>
  </header>

  <section class="mb-42">
    <div class="packages mb-12">
      <table class="mb-6">
        <thead>
          <tr>
            <td class="h6">What you get</td>
            <?php foreach ($packages as $package): ?>
              <th class="<?= $package['class'] ?? '' ?>"><?= $package['title'] ?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($benefits as $key => $data): ?>
            <tr>
              <th>
                <strong><?= $data['label'] ?></strong>
                <small><?= $data['help'] ?></small>
              </th>
              <?php foreach ($packages as $package): ?>
                <td>
                  <?php $value = $package['benefits'][$key] ?>
                  <?php if (is_bool($value) === true): ?>
                    <?= $value === true ? '✓' : '<span class="empty">–</span>' ?>
                  <?php else: ?>
                    <?= $value  ?>
                  <?php endif ?>
                </td>
              <?php endforeach ?>
            </tr>
          <?php endforeach ?>
      </table>

      <table class="mb-6">
        <thead>
          <tr>
            <td class="h6">What we ask for</td>
            <?php foreach ($packages as $package): ?>
              <th class="<?= $package['class'] ?? '' ?>"><?= $package['title'] ?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($requirements as $key => $data): ?>
            <tr>
              <th>
                <strong><?= $data['label'] ?></strong>
                <small><?= $data['help'] ?></small>
              </th>
              <?php foreach ($packages as $package): ?>
                <td>
                  <?php $value = $package['requirements'][$key] ?>
                  <?php if (is_bool($value) === true): ?>
                    <?= $value === true ? '✓' : '<span class="empty">–</span>' ?>
                  <?php else: ?>
                    <?= $value  ?>
                  <?php endif ?>
                </td>
              <?php endforeach ?>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>

      <table>
        <thead>
          <tr>
            <td class="h6">What you pay</td>
            <?php foreach ($packages as $package): ?>
              <th class="<?= $package['class'] ?? '' ?>"><?= $package['title'] ?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><strong>Price per year</strong> <small>+ VAT if applicable</small></th>
            <?php foreach ($packages as $package): ?>
              <td class="bg-white">
                <strong><?= $package['price'] ?></strong>
              </td>
            <?php endforeach ?>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <th>&nbsp;</th>
            <?php foreach ($packages as $package): ?>
              <td>
                <a href="https://airtable.com/shrrNVO56SWhB7Ulq?prefill_Package=<?= Escape::url(Str::unhtml($package['title'])) ?>" class="btn btn--filled">
                  <?= $package['class'] ?? '' === 'plus' ? icon('verified') . ' ' : ''?>Get <?= $package['title'] ?>
                </a>
              </td>
            <?php endforeach ?>
          </tr>
        </tfoot>
      </table>
    </div>

  </section>

  <section class="mb-42">
    <h2 class="h2 mb-6">Frequently asked questions</h2>
    <?php snippet('faq') ?>
  </section>

</article>
