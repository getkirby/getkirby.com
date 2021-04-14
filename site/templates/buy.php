<?php layout() ?>

<article>
  <div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: 3rem">

    <h1 class="h1 max-w-xl">
      The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
    </h1>

    <a href="https://pay.paddle.com/checkout/499826" class="pricing highlight bg-white shadow-xl">
      <p class="h1 mb-3 price invisible">99 € per site</p>
      <div class="columns" style="--columns: 2; --gap: var(--spacing-12)">
        <div class="flex flex-column justify-between">
          <p class="h6 mb-12 vat invisible">+ VAT if applicable</p>
          <p>
            <button class="btn btn--filled mb-1">
              <?= icon('cart') ?>
              Buy Kirby
            </button>
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
    <h2 class="h2 mb-6">Frequently asked questions</h2>
    <?php snippet('faq') ?>
  </section>

  <section class="columns columns--reverse" style="--columns: 2; --gap: var(--spacing-12)">
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
      <?php foreach (collection('causes')->shuffle()->limit(2) as $case): ?>
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

</article>

<script src="https://cdn.paddle.com/paddle/paddle.js"></script>
<script type="text/javascript">
  Paddle.Setup({
    vendor: 1129,
  });

  Paddle.Product.Prices(499826, function(prices) {
    let price = prices.price.net.replace(".00", "").replace("US$", "$");
    let priceElement = document.querySelector(".price");
    let vatElement = document.querySelector(".vat");

    priceElement.innerText = `${price} per site`;
    priceElement.classList.remove("invisible");

    vatElement.classList.remove("invisible");
  });

  document.querySelector(".pricing").addEventListener("click", function (e) {
    e.preventDefault();
    Paddle.Checkout.open({
      product: 499826
    });
  }, false);
</script>
