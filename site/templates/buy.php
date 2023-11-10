<?php layout() ?>

<style>
.checklist {
	font-size: var(--text-sm);
}
.checklist li {
	display: flex;
	align-items: center;
	gap: .5rem;
}
.checklist li + li {
	margin-top: .25rem;
}

.revenue {
	position: relative;
	font-size: var(--text-sm);
	margin-top: 1.25rem;
	margin-bottom: 3rem;
}
.revenue summary {
	background: var(--color-yellow-300);
	color: var(--color-yellow-900);
	border-radius: 2rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: .25rem .75rem;
	padding-right: .5rem;
}
.revenue summary svg {
	color: var(--color-yellow-700);
	margin-top: 1px;
}
.revenue div {
	position: absolute;
	top: 100%;
	left: 50%;
	width: 20rem;
	transform: translateX(-50%);
	background: black;
	color: white;
	margin-top: 1rem;
	padding: 1rem;
	border-radius: var(--rounded);
	box-shadow: var(--shadow-xl);
}
.revenue div::after {
	position: absolute;
	top: -4px;
	left: 50%;
	content: "";
	border-left: 4px solid transparent;
	border-bottom: 4px solid black;
	border-right: 4px solid transparent;
}
.revenue div p + p {
	margin-top: .75rem;
}
.revenue div strong {
	font-weight: var(--font-normal);
	color: var(--color-yellow-500);
}

</style>


<article>
  <div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: var(--spacing-6)">

		<div>
			<h1 class="h1 max-w-xl mb-24">
				The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
			</h1>
		</div>

		<div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
	    <div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>Basic</h2>
					<a href="https://pay.paddle.com/checkout/824338" target="_blank" class="h2 block mb-3">
						<k-price product="824338">€99</k-price> per site
					</a>
					<p class="text-sm color-gray-700">A discounted license for individuals, small teams and side projects</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>€1M / year</strong></span> <?= icon('info') ?></summary>
					<div>
						<p>Your revenue or funding is less than <strong>€1&nbsp;million</strong> in the <strong>last 12 months</strong></p>
						<p>If you build a website for a client, the limit has to fit the revenue of your client.</p>
					</div>
				</details>

				<ul class="checklist mb-6">
					<li>
						<?= icon('check') ?>
						No subscription
					</li>
					<li>
						<?= icon('check') ?>
						3 years of free upgrades
					</li>
					<li>
						<?= icon('check') ?>
						All features included
					</li>
					<li>
						<?= icon('check') ?>
						No hidden costs
					</li>
				</ul>

				<footer>
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
					<p class="text-sm color-gray-700">Suitable for larger organizations with mission-critical projects</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>No limit</strong></span> <?= icon('info') ?></summary>
					<div>
						This license does not have a revenue limit.
					</div>
				</details>

				<ul class="checklist mb-6">
					<li>
						<?= icon('check') ?>
						No subscription
					</li>
					<li>
						<?= icon('check') ?>
						3 years of free upgrades
					</li>
					<li>
						<?= icon('check') ?>
						All features included
					</li>
					<li>
						<?= icon('check') ?>
						No hidden costs
					</li>
				</ul>

				<footer>
					<p>
						<a href="https://pay.paddle.com/checkout/824340" target="_blank" class="btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy Enterprise
						</a>
					</p>
				</footer>
			</div>
			<p class="text-xs text-center font-mono mb-6 color-gray-700" style="--span: 2">Prices + VAT if applicable. By purchasing Kirby, you agree to our <a class="underline" href="<?= url('license') ?>">License terms</a></p>
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

  <section class="mb-42">
    <h2 class="h2 mb-6">Frequently asked questions</h2>
    <?php snippet('faq') ?>
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

document.addEventListener("click", (event) => {
	[...document.querySelectorAll("details")].forEach(details => {
		if (details.contains(event.target) === false) {
			details.removeAttribute("open");
		}
	});
});

</script>
<script src="https://checkout.paddle.com/api/2.0/prices?product_ids=824338,824340&callback=paddle_price"></script>
