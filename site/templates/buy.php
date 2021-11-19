<?php layout() ?>

<article>
  <div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: 3rem">

    <h1 class="h1 max-w-xl">
      The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
    </h1>

    <a href="https://pay.paddle.com/checkout/<?= $product ?>" title="Buy Kirby" class="pricing highlight bg-white shadow-xl">

      <?php if ($banner) : ?>
        <div>
          <p class="mb-6"><?= $banner->text() ?></p>
          <del class="invisible sale h6 color-gray-700">€</del>
        </div>
      <?php endif ?>
      <p class="h1 mb-3 price invisible"><span>€</span> per site</p>

      <div class="columns" style="--columns: 2; --gap: var(--spacing-12)">
        <div class="flex flex-column justify-between">
          <p class="h6 mb-12 vat invisible">+ VAT if applicable</p>
          <p>
            <span class="btn btn--filled mb-1">
              <?= icon('cart') ?>
              Buy Kirby
            </span>
          </p>
        </div>
        <div>
          <p class="h6 mb-3">Let's keep it simple</p>
          <ul class="text-lg">
            <li class="flex items-center">
              <figure class="mr-3"><?= icon('check') ?></figure>
              One price
            </li>
            <li class="flex items-center">
              <figure class="mr-3"><?= icon('check') ?></figure>
              All features
            </li>
            <li class="flex items-center">
              <figure class="mr-3"><?= icon('check') ?></figure>
              No hidden fees
            </li>
            <li class="flex items-center">
              <figure class="mr-3"><?= icon('check') ?></figure>
              No subscription
            </li>
          </ul>
        </div>
      </div>
    </a>
  </div>

  <section class="mb-42">
    <h2 class="h2 mb-6">Volume discounts</h2>
    <div class="columns" style="--columns: 4; --gap: var(--spacing-1)">
      <?php foreach ($discounts as $volume => $discount) : ?>
        <a class="block" target="_blank" href="/buy/checkout/<?= $volume ?>" data-discount="<?= $discount ?>" data-volume="<?= $volume ?>">
          <article class="p-12 bg-light text-center">
            <h3 class="mb-3 font-mono text-sm"><?= $volume ?> licenses</h3>
            <p class="h2 mb-6 discounted-price">&nbsp;</p>
            <p class="btn btn--outlined font-bold">
              <?= icon('cart') ?>
              Save <?= $discount ?>%
            </p>
          </article>
        </a>
      <?php endforeach ?>
      <a class="block" href="mailto:support@getkirby.com">
        <article class="p-12 bg-light text-center">
          <h3 class="mb-3 font-mono text-sm">Custom packages</h3>
          <p class="h2 mb-6 discounted-price">Contact us</p>
          <p class="btn btn--outlined font-bold">
            <?= icon('user') ?>
            Support
          </p>
        </article>
      </a>
    </div>
    <p class="font-mono text-sm text-center pt-3">+ VAT if applicable.</p>
  </section>

  <section class="mb-42">
    <h2 class="h2 mb-6">Frequently asked questions</h2>
    <?php snippet('faq') ?>
  </section>

  <section class="mb-42 columns columns--reverse" style="--columns: 2; --gap: var(--spacing-12)">
    <div>
      <h2 class="h2 mb-6">For a good cause?</h2>
      <div class="prose mb-12">
        <p>We care about a better society and the future of our planet. We support students, educational projects, social and environmental organizations, charities and non-profits with free&nbsp;licenses.</p>
      </div>
      <a class="btn btn--filled" href="mailto:support@getkirby.com">
        <?= icon('heart') ?>
        Contact us
      </a>
    </div>
    <ul class="columns" style="--columns: 2; --gap: var(--spacing-12);">
      <?php foreach (collection('causes')->shuffle()->limit(2) as $case) : ?>
        <li>
          <a href="<?= $case->link()->toUrl() ?>">
            <figure>
              <span class="block shadow-2xl mb-3" style="--aspect-ratio: 3/4">
                <?= img($image = $case->image(), [
                  'alt' => 'Screenshot of the ' . $image->alt() . ' website',
                  'src' => [
                    'width' => 300
                  ],
                  'srcset' => [
                    '1x' => 400,
                    '2x' => 800,
                  ]
                ]) ?>
              </span>
              <figcaption class="text-sm">
                <?= $case->title() ?>
              </figcaption>
            </figure>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </section>

  <footer class="h2 max-w-xl">
    Manage your existing licenses on our <a href="https://licenses.getkirby.com"><span class="link">license&nbsp;server</span> &rarr;</a>
  </footer>

</article>

<script type="text/javascript">
  function paddle_price(data) {
    const product      = data.response.products[0];
    const currency     = product.currency;
    const currentPrice = product.price.net;
    const listPrice    = product.list_price.net;
    const isSale       = currentPrice !== listPrice;

    // Try to use formatter with narrow currency symbol,
    // fall back to normal symbol if not supported by browser
    let formatter;
    try {
      formatter = new Intl.NumberFormat("en", {
        style: "currency",
        currency,
        currencyDisplay: "narrowSymbol",
        minimumFractionDigits: 0
      });
    } catch (e) {
      if (e.constructor !== RangeError) {
        throw e;
      }
      formatter = new Intl.NumberFormat("en", {
        style: "currency",
        currency,
        minimumFractionDigits: 0
      });
    }

    const $price = document.querySelector(".price");
    const $vat   = document.querySelector(".vat");
    const $sale  = document.querySelector(".sale");

    $price.firstElementChild.innerText = formatter.format(currentPrice);
    $price.classList.remove("invisible");
    $vat.classList.remove("invisible");

    Array.from(document.querySelectorAll("[data-discount]")).forEach(discountBox => {
      const volume    = parseInt(discountBox.getAttribute("data-volume"));
      const discount  = parseInt(discountBox.getAttribute("data-discount"));
      const price     = currentPrice * ((100 - discount) / 100) * volume;
      const nicePrice = Math.floor(price / 5) * 5;

      discountBox.querySelector(".discounted-price").innerText = formatter.format(nicePrice);
    });

    if (isSale) {
      $sale.innerHTML = formatter.format(listPrice);
      $sale.classList.remove("invisible");
    }
  }
</script>

<script src="https://checkout.paddle.com/api/2.0/prices?product_ids=<?= $product ?>&callback=paddle_price"></script>

<script type="module">
  import {
    Checkout
  } from "<?= url('/assets/js/components/paddle.js') ?>";
  new Checkout();
</script>
