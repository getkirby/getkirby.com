<?php layout() ?>


<article>
  <div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: var(--spacing-6)">

		<div>
			<h1 class="h1 max-w-xl mb-24">
				The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
			</h1>
			<ul class="text-lg">
				<li class="flex items-center">
					<figure class="mr-3"><?= icon('check') ?></figure>
					No subscription
				</li>
				<li class="flex items-center">
					<figure class="mr-3"><?= icon('check') ?></figure>
					3 years of free upgrades
				</li>
				<li class="flex items-center">
					<figure class="mr-3"><?= icon('check') ?></figure>
					All features included
				</li>
				<li class="flex items-center">
					<figure class="mr-3"><?= icon('check') ?></figure>
					No hidden costs
				</li>
			</ul>

		</div>

		<div class="columns" style="--columns: 2; --gap: var(--spacing-3)">
	    <div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>Basic</h2>
					<a href="https://pay.paddle.com/checkout/824338" target="_blank" class="h2 block mb-3">
						<k-price product="824338">€99</k-price> per site
					</a>
					<p class="text-sm color-gray-700">A discounted license for smaller websites and apps</p>
				</header>
				<footer>
					<p class="text-sm mb-3"><i class="color-gray-700">Revenue Limit</i><br>Less than €1M per year</p>
					<p>
						<a href="https://pay.paddle.com/checkout/824338" target="_blank" class="btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy Basic
						</a>
					</p>
				</footer>
			</div>

	    <div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>Enterprise</h2>
					<a href="https://pay.paddle.com/checkout/824340" target="_blank" class="h2 block mb-3">
						<k-price product="824340">€399</k-price> per site
					</a>
					<p class="text-sm color-gray-700">Suitable for large organisations with mission-critical projects</p>
				</header>

				<footer>
					<p class="text-sm mb-3"><i class="color-gray-700">Revenue Limit</i><br>No limit</p>
					<p>
						<a href="https://pay.paddle.com/checkout/824340" target="_blank" class="btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy Enterprise
						</a>
					</p>
				</footer>
			</div>
		</div>
  </div>

  <section class="mb-42">
    <h2 class="h2 mb-6">Volume discounts</h2>
    <div class="columns rounded overflow-hidden" style="--columns-md: 2; --columns: 4; --gap: var(--spacing-3)">
      <?php foreach ($discounts as $volume => $discount) : ?>
        <a class="block p-12 bg-light rounded text-center" target="_blank" href="/buy/checkout/<?= $volume ?>" data-discount="<?= $discount ?>" data-volume="<?= $volume ?>">
          <article>
            <h3 class="mb-3 font-mono text-sm"><?= $volume ?> licenses</h3>
            <?php if ($banner): ?>
              <del class="invisible discounted-list-price h6" style="color: var(--color-purple-600)">€</del>
            <?php endif ?>
            <p class="h2 mb-6 discounted-price">&nbsp;</p>
            <p class="btn btn--filled">
              <?= icon('cart') ?>
              Save <?= $discount ?>%<?php if ($banner): ?> on top<?php endif ?>!
            </p>
          </article>
        </a>
      <?php endforeach ?>
      <a class="block p-12 bg-light text-center" href="mailto:support@getkirby.com">
        <article>
          <h3 class="mb-3 font-mono text-sm">Custom packages</h3>
          <?php if ($banner): ?>
            <span class="block">&nbsp;</span>
          <?php endif ?>
          <p class="h2 mb-6 discounted-price">Contact us</p>
          <p class="btn btn--outlined">
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

class Price extends HTMLElement {

	constructor() {
		super();

		this.id = this.getAttribute("product");
		this.product = window.paddle.products.find(({ product_id}) => product_id == this.id);
		this.currency = this.product.currency;
		this.price = this.product.list_price.net;
	}

	connectedCallback() {

    // Try to use formatter with narrow currency symbol,
    // fall back to normal symbol if not supported by browser
    let formatter;
    try {
      formatter = new Intl.NumberFormat("en", {
        style: "currency",
        currency: this.currency,
        currencyDisplay: "narrowSymbol",
        minimumFractionDigits: 0
      });
    } catch (e) {
      if (e.constructor !== RangeError) {
        throw e;
      }
      formatter = new Intl.NumberFormat("en", {
        style: "currency",
        currency: this.currency,
        minimumFractionDigits: 0
      });
    }

		this.innerHTML = formatter.format(this.price);
	}

}

function paddle_price(data) {
	window.paddle = data.response;
	customElements.define("k-price", Price);
}

</script>
<script src="https://checkout.paddle.com/api/2.0/prices?product_ids=824338,824340&callback=paddle_price"></script>
