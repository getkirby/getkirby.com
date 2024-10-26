<?php

namespace Kirby\Buy;

use Exception;
use Kirby\Toolkit\A;

class Price
{
	public readonly string $currency;
	public readonly float $rate;
	public readonly float $rateAdjusted;

	public function __construct(
		public readonly Product $product,
		string|null $currency = null,
		float|null $rate = null
	) {
		if ($currency === 'EUR') {
			// allow missing rate as it's always 1
			if ($rate === null) {
				$rate = 1.0;
			}

			// every other rate is invalid
			// because of hardcoded EUR prices
			if ($rate !== 1.0) {
				throw new Exception('Conversion rate for EUR must be 1.0');
			}
		}

		// currency and rate always need to both not be passed
		// or passed together, one alone won't work
		if ($currency === null xor $rate === null) {
			throw new Exception('Passing just one of currency or rate is not supported');
		}

		// dynamically determine from Paddle
		// (only in this case can there be a PPP-adjusted rate)
		if ($rate === null) {
			$visitor = Paddle::visitor();

			$currency     = $visitor->currency();
			$rate         = $visitor->rate();
			$rateAdjusted = $visitor->rateAdjusted();
		}

		$this->currency     = $currency;
		$this->rate         = $rate;
		$this->rateAdjusted = $rateAdjusted ?? $rate;
	}

	/**
	 * Converts a price from EUR to the given currency
	 * and rounds it to the nearest pretty price
	 *
	 * @param bool $charm Whether prices will end in 5/9 (when true)
	 *                    or 0/5 (when false)
	 * @param bool $adjust Whether to perform PPP adjustment to the generated price
	 */
	public function convert(int $price, bool $charm = true, bool $adjust = false): int
	{
		$price *= $adjust ? $this->rateAdjusted : $this->rate;
		return $this->round($price, $charm);
	}

	/**
	 * Gets the additional optional donation amount
	 * per license in the customer currency
	 */
	public function customerDonation(): int
	{
		return $this->convert(option('buy.donation.customerAmount'));
	}

	/**
	 * Returns a summary of all applied discounts
	 */
	public function discounts(): string
	{
		$discounts = [];

		if ($this->rateAdjusted !== $this->rate) {
			$pppPercentage = sprintf('%+1.2F', 100 * (1 - $this->rateAdjusted / $this->rate));
			$discounts[]   = 'PPP (' . $pppPercentage . '%)';
		}

		$sale = new Sale();
		if ($sale->isActive()) {
			$discounts[] = 'Sale (' . $sale->discount() . '%)';
		}

		return implode(', ', $discounts);
	}

	/**
	 * Gets the team donation amount
	 * per license in the customer currency
	 */
	public function teamDonation(): int
	{
		return $this->convert(option('buy.donation.teamAmount'));
	}

	/**
	 * Rounds a price to the nearest pretty price
	 * (ending in -5 or -9)
	 *
	 * @param bool $charm If `true`, price will end in 5 or 9, otherwise 0 or 5
	 */
	public function round(float $price, bool $charm = true): int
	{
		// if the currency is strong, only round
		// the price to full units as "pretty"
		// rounding would change the price a lot
		if ($this->rate < 0.5) {
			return round($price);
		}

		$step = $this->step();

		// apply "pretty" rounding so that for EUR
		// the rounding is applied on the last place
		// and for a currency with 10x higher prices
		// on the second-last place
		$rounded = round($price / 5 / $step) * 5 * $step;

		// if that brought us to zero, round by one place fewer
		if ($rounded < 1 && $step >= 10) {
			$step /= 10;
			$rounded = round($price / 5 / $step) * 5 * $step;
		}

		if ($charm === true && $rounded % max($step, 10) === 0) {
			$rounded -= 1;
		}

		// fall back to the original price if we ended up at zero
		// (relevant for currencies with `$step = 1`)
		if ($rounded < 1) {
			return round($price);
		}

		return $rounded;
	}

	/**
	 * Gets the regular price for the product
	 *
	 * @param int $multiplier Optional price multiplier (used for partner products)
	 */
	public function regular(int $multiplier = 1): int
	{
		$rawPrice = $this->product->rawPrice();
		$adjust   = $this->product->adjustForPPP();

		if ($multiplier > 1) {
			// first use the base price without 9 ending
			// (avoids jumps between 5 and 9 for multiplied prices)
			$price = $multiplier * $this->convert($rawPrice, charm: false, adjust: $adjust);

			// now round the final sum to the nearest pretty price
			return $this->round($price);
		}

		return $this->convert($rawPrice, adjust: $adjust);
	}

	/**
	 * Gets the sale price for the product
	 * (regular price if no sale is active)
	 */
	public function sale(): int
	{
		$sale  = new Sale();
		$price = $this->regular();

		if ($sale->isActive() === true) {
			$price *= 1 - $sale->discount() / 100;

			// use the pretty rounding if possible, but ensure that
			// the price is never higher than the mathematical sale
			// price from the discount percentage we promise
			return min($this->round($price), floor($price));
		}

		return $price;
	}

	/**
	 * Calculates the order of magnitude of
	 * the currency compared to EUR
	 */
	public function step(): int
	{
		$length     = strlen((int)$this->rate);
		$firstDigit = ((string)$this->rate)[0];

		return pow(10, $firstDigit >= 5 ? $length : $length - 1);
	}

	/**
	 * Gets the upgrade prices object
	 */
	public function upgrade(): Upgrade
	{
		return new Upgrade($this);
	}

	/**
	 * Gets the price for a single license
	 * at the given volume
	 */
	public function volume(int $volume): float
	{
		$price = $this->sale();

		// sort discounts by largest package first
		$discounts = option('buy.volume');
		krsort($discounts);

		// find highest possible discount for given volume
		$discount = A::find(
			$discounts,
			fn ($discount, $count) => $count <= $volume
		);

		$price *= 1 - $discount / 100;

		return round($price, 2);
	}
}
