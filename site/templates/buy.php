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
.revenue summary::-webkit-details-marker {
	display: none;
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
.currency-sign {
	font-size: var(--text-xl);
	padding-right: 0.25em;
}
k-price-info:not(.loaded) {
	color: var(--color-gray-600);
}

@media (max-width: 40rem) {
	.causes li:not(:first-child) {
		display: none;
	}
}

.volume-toggles {
	display: flex;
	align-items: center;
	gap: 1.5rem;
}
.volume-toggles label {
	display: flex;
	align-items: center;
	gap: .5rem;
	cursor: pointer;
}
</style>

<article>
	<div class="columns mb-42" style="--columns-sm: 1; --columns-md: 1; --columns-lg: 2; --gap: var(--spacing-6)">

		<div>
			<h1 class="h1 max-w-xl mb-6">
				The transparency of <a href="https://github.com/getkirby">open&#8209;source</a> meets a fair pricing&nbsp;model
			</h1>

			<?php if ($sale->isActive()): ?>
				<div class="h3 sale mb-12">
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
						<span class="px-1 color-gray-700 strikethrough">
							<k-price-info key="currency-sign">€</k-price-info><!--
							--><k-price-info key="basic-regular"><?= Buy\Product::Basic->price('EUR')->regular() ?></k-price-info>
						</span>
						<?php endif ?>
					</h2>

					<a href="/buy/basic" target="_blank" class="h2 block mb-3">
						<k-price-info key="currency-sign-trimmed" class="sale currency-sign">€</k-price-info><!--
						--><k-price-info key="basic-sale" class="sale"><?= Buy\Product::Basic->price('EUR')->sale() ?></k-price-info>
						per site
					</a>

					<p class="text-sm color-gray-700">A discounted license for individuals, small teams and side projects</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>€1M / year</strong></span> <?= icon('info') ?></summary>
					<div>
						<p>Your revenue or funding is less than <strong>€1&nbsp;million<k-price-info key="revenue-limit"></k-price-info></strong> in the <strong>last 12 months</strong>.</p>
						<p>If you build a website for a client, the limit has to fit the revenue of your client.</p>
					</div>
				</details>

				<?php snippet('templates/buy/checklist') ?>

				<footer>
					<p>
						<a href="/buy/basic" target="_blank" class="btn btn--filled mb-1 w-100%">
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
						<span class="px-1 color-gray-700 strikethrough">
							<k-price-info key="currency-sign">€</k-price-info><!--
							--><k-price-info key="enterprise-regular"><?= Buy\Product::Enterprise->price('EUR')->regular() ?></k-price-info>
						</span>
						<?php endif ?>
					</h2>

					<a href="/buy/enterprise" target="_blank" class="h2 block mb-3">
						<k-price-info key="currency-sign-trimmed" class="sale currency-sign">€</k-price-info><!--
						--><k-price-info key="enterprise-sale" class="sale"><?= Buy\Product::Enterprise->price('EUR')->sale() ?></k-price-info>
						per site
					</a>

					<p class="text-sm color-gray-700">Suitable for larger companies and organizations</p>
				</header>

				<details class="revenue">
					<summary><span>Revenue limit: <strong>No limit</strong></span> <?= icon('info') ?></summary>
					<div>
						This license does not have a revenue limit.
					</div>
				</details>

				<?php snippet('templates/buy/checklist') ?>

				<footer>
					<p>
						<a href="/buy/enterprise" target="_blank" class="btn btn--filled mb-1 w-100%">
							<?= icon('cart') ?>
							Buy Enterprise
						</a>
					</p>
				</footer>
			</div>
			<p class="text-xs text-center mb-6 color-gray-700" style="--span: 2">Prices + VAT if applicable. With your purchase you agree to our <a class="underline" href="<?= url('license') ?>">License terms</a></p>
		</div>
	</div>

	<section class="mb-42">
		<form class="volume-discounts" method="POST" target="_blank" action="<?= url('buy/volume') ?>">
			<header class="flex items-baseline justify-between mb-6">
				<h2 class="h2">Volume discounts</h2>
				<fieldset>
					<legend class="sr-only">License Type</legend>
					<div class="volume-toggles">
						<label><input type="radio" name="product" value="basic" checked> Basic</label>
						<label><input type="radio" name="product" value="enterprise"> Enterprise</label>
					</div>
				</fieldset>
			</header>
			<div class="columns rounded overflow-hidden" style="--columns-md: 2; --columns: 4; --gap: var(--spacing-3)">
				<?php foreach ($discounts as $volume => $discount) : ?>
					<div class="block p-12 bg-light rounded text-center" >
						<article>
							<h3 class="mb text-sm">
								<?= $volume ?> licenses
							</h3>
							<div class="mb-6">
								<p class="h2">
									Save <?= $discount ?>%
								</p>
								<?php if ($sale->isActive()): ?>
									<p class="sale text-sm">on top!</p>
								<?php endif ?>
							</div>

							<button class="btn btn--filled mb-3" name="volume" value="<?= $volume ?>">
								<?= icon('cart') ?> Buy now
							</button>
						</article>
					</div>
				<?php endforeach ?>
				<a class="block p-12 bg-light text-center" href="mailto:support@getkirby.com">
					<article>
						<h3 class="text-sm">Custom packages</h3>

						<div class="mb-6">
							<p class="h2">
								Contact us
							</p>
							<?php if ($sale->isActive()): ?>
								<p class="sale">&nbsp;</p>
							<?php endif ?>
						</div>

						<p class="btn btn--outlined">
							<?= icon('user') ?>
							Support
						</p>
					</article>
				</a>
			</div>
		</form>
	</section>

	<section class="mb-42 columns columns--reverse" style="--columns: 2; --columns-md: 1; --gap: var(--spacing-36)">
		<div>

			<h2 class="h2 mb-6">For a good cause? <mark class="px-1 rounded">It’s free.</mark></h2>
			<div class="prose mb-6">
				<p>We care about a better society and the future of our planet. We offer free&nbsp;licenses for <strong>students, selected educational projects, social and environmental organizations, charities and non-profits</strong> with insufficient funding.</p>
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

	<footer class="h2">
		Manage your existing licenses in our <a href="https://hub.getkirby.com"><span class="link">license&nbsp;hub</span> &rarr;</a>
	</footer>

</article>

<script type="module">
// close price details on clicks outside the details
document.addEventListener("click", (event) => {
	for (const details of [...document.querySelectorAll("details")]) {
		if (details.contains(event.target) === false) {
			details.removeAttribute("open");
		}
	}
});

class PriceInfo extends HTMLElement {
	constructor() {
		super();

		this.key = this.getAttribute("key");
		this.value = window.priceInfo[this.key];

		// format price values
		if (Number.isFinite(this.value) === true) {
			const formatter = new Intl.NumberFormat("en");
			this.value = formatter.format(this.value);
		}
	}

	connectedCallback() {
		this.textContent = this.value;
		this.classList.add("loaded");
	}
}

// fetch with options that allow using the preloaded response
const response = await fetch("<?= url('buy/prices') ?>", {
	method: "GET",
	credentials: "include",
	mode: "no-cors",
});
window.priceInfo = await response.json();

customElements.define("k-price-info", PriceInfo);
</script>
