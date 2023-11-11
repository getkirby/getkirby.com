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

.sale {
	color: var(--color-purple-600);
}
.strikethrough {
	text-decoration: line-through;
}

@media (max-width: 40rem) {
	.causes li:not(:first-child) {
		display: none;
	}
}
</style>

<article>
  <div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: var(--spacing-6)">

		<div>
			<h1 class="h1 max-w-xl mb-24">
				The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
			</h1>

			<?php if ($sale->isActive()): ?>
				<div class="h2 sale">
					<?= $sale->text() ?>
				</div>
			<?php endif ?>
		</div>

		<div class="columns" style="--columns: 2; --gap: var(--spacing-6)">
	    <div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>
						Basic

						<?php if ($sale->isActive()): ?>
						<k-price product="basic" price="regular" class="sale strikethrough">
							€<?= Buy\Product::Basic->price()->regular() ?>
						</k-price>
						<?php endif ?>
					</h2>

					<a href="/buy/basic/" target="_blank" class="checkout-link h2 block mb-3">
						<k-price product="basic" price="sale">
							€<?= Buy\Product::Basic->price()->sale() ?>
						</k-price> per site
					</a>

					<p class="text-sm color-gray-700">A discounted license for individuals, small teams and side projects</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>€1M / year</strong></span> <?= icon('info') ?></summary>
					<div>
						<p>Your revenue or funding is less than <strong>€1&nbsp;million</strong> in the <strong>last 12 months</strong>.</p>
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
						<a href="/buy/basic/" target="_blank" class="checkout-link btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy Basic
						</a>
					</p>
				</footer>
			</div>

	    <div class="pricing p-6 bg-white shadow-xl rounded flex flex-column justify-between">
				<header>
					<h2>
						Enterprise

						<?php if ($sale->isActive()): ?>
						<k-price product="enterprise" price="regular" class="sale strikethrough">
							€<?= Buy\Product::Enterprise->price()->regular() ?>
						</k-price>
						<?php endif ?>
					</h2>

					<a href="/buy/enterprise/" target="_blank" class="checkout-link h2 block mb-3">
						<k-price product="enterprise" price="sale">
							€<?= Buy\Product::Enterprise->price()->sale() ?>
						</k-price> per site
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
						<a href="/buy/enterprise/" target="_blank" class="checkout-link btn btn--filled mb-1 w-100%">
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
        <div class="block p-12 bg-light rounded text-center" >
          <article>
            <h3 class="mb-3 font-mono text-sm">
							Save <?= $discount ?>%<?php if ($sale->isActive()): ?><span class="sale"> on top</span><?php endif ?>!
						</h3>
						<p class="h2 mb-6">
							<?= $volume ?> licenses
						</p>
            <a target="_blank" href="/buy/volume/basic/<?= $volume ?>/" class="checkout-link btn btn--filled mb-3">
              <?= icon('cart') ?> Basic
						</a>
						<a target="_blank" href="/buy/volume/enterprise/<?= $volume ?>/" class="checkout-link btn btn--filled">
              <?= icon('cart') ?> Enterprise
						</a>
          </article>
				</div>
      <?php endforeach ?>
      <a class="block p-12 bg-light text-center" href="mailto:support@getkirby.com">
        <article>
          <h3 class="mb-3 font-mono text-sm">Custom packages</h3>
          <p class="h2 mb-6">Contact us</p>
          <p class="btn btn--outlined">
            <?= icon('user') ?>
            Support
          </p>
        </article>
      </a>
    </div>
    <p class="font-mono text-sm text-center pt-3">+ VAT if applicable.</p>
  </section>

  <section class="mb-42 columns columns--reverse" style="--columns: 2; --columns-md: 1; --gap: var(--spacing-24)">
    <div>

      <h2 class="h2 mb-6">For a good cause? <mark>It's free.</mark></h2>
      <div class="prose mb-6">
        <p>We care about a better society and the future of our planet. We support <mark>students, educational projects, social and environmental organizations, charities and non-profits</mark> with free&nbsp;licenses.</p>
      </div>

      <a class="btn btn--filled mb-12" href="mailto:support@getkirby.com">
        <?= icon('heart') ?>
        Contact us
      </a>

			<ul class="columns causes" style="--columns: 2; --gap: var(--spacing-12);">
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
		</div>

		<div>
			<h2 class="h2 mb-6">Frequently asked questions</h2>
			<?php snippet('faq') ?>
		</div>
	</section>

  <footer class="h2 max-w-xl">
    Manage your existing licenses on our <a href="https://licenses.getkirby.com"><span class="link">license&nbsp;server</span> &rarr;</a>
  </footer>

</article>

<script type="text/javascript">

class Price extends HTMLElement {

	constructor() {
		super();

		this.product = this.getAttribute("product");
		this.price = this.getAttribute("price");
		this.currency = window.currency;
		this.price = window.prices[this.product][this.price];
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

async function paddle_price(data) {
	window.currency = data.response.products[0].currency;

	const response = await fetch("/buy/prices/" + window.currency);
	window.prices  = await response.json();

	customElements.define("k-price", Price);

	for (const link of [...document.querySelectorAll(".checkout-link")]) {
		link.href += window.currency;
	}
}

document.addEventListener("click", (event) => {
	for (const details of [...document.querySelectorAll("details")]) {
		if (details.contains(event.target) === false) {
			details.removeAttribute("open");
		}
	}
});
</script>
<script src="https://checkout.paddle.com/api/2.0/prices?product_ids=824338&callback=paddle_price"></script>
