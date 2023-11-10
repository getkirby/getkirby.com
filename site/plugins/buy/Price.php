<?php

namespace Buy;

use Kirby\Data\Data;

class Price
{
	public readonly float $rate;

	public function __construct(
		public readonly Product $product,
		public readonly string $currency = 'EUR'
	) {
		$rates = Data::read(__DIR__ . '/rates.json');
		$this->rate = $rates[$currency];

	}

	/**
	 * Converts a price from EUR to the given currency
	 * and rounds it to the nearest pretty price
	 */
	public function convert(int $price): int
	{
		$price *= $this->rate;
		return static::round($price);
	}

	/**
	 * Converts a price back into EUR
	 */
	public function euros(int $price): float
	{
		return $price / $this->rate;
	}

	/**
	 * Rounds a price to the nearest pretty price
	 * (ending in -5 or -9)
	 */
	public static function round(float $price): int
	{
		$price = round($price / 5) * 5;

		if ($price % 10 === 0) {
			$price -= 1;
		}

		return max(0, $price);
	}

	/**
	 * Gets the regular price for the product
	 */
	public function regular(): int
	{
		return $this->convert(
			option('buy.' . $this->product->value . '.regular')
		);
	}

	/**
	 * Gets the sale price for the product
	 * (regular price if no sale is active)
	 */
	public function sale(): int
	{
		$price = $this->regular();

		if ($sale = option('buy.sale')) {
			$price  = static::round($price * $sale);
		}

		return $price;
	}

	/**
	 * Gets the upgrade prices object
	 */
	public function upgrade(): Upgrade
	{
		return new Upgrade($this);
	}

	/**
	 * Gets the total price for the given volume
	 */
	public function volume(int $volume): float
	{
		$price    = $this->sale();
		$discount = option('buy.volume')[$volume];
		$price   *= (1 - ($discount / 100));
		$price   *= $volume;
		return round($price, 2);
	}
}
