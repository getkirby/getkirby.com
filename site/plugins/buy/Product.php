<?php

namespace Buy;

enum Product: string
{
	case Basic 	    = 'basic';
	case Enterprise = 'enterprise';

	/**
	 * Generates a checkout link for the product
	 */
	public function checkout(
		string $type = 'buy',
		array $payload = []
	): string {
		$product = match ($type) {
			'buy'     => $this->productId(),
			'upgrade' => $this->upgradeId(),
			'free'    => $this->upgradeId(true),
		};

		return Paddle::checkout($product, $payload);
	}

	/**
	 * Returns the price object for the product
	 */
	public function price(string $currency = 'EUR'): Price
	{
		// really ensure that we have a valid currency
		if (empty($currency) === true) {
			$currency = 'EUR';
		}

		return new Price($this, $currency);
	}

	/**
	 * Returns the Paddle product ID
	 */
	public function productId(): int
	{
		return option('buy.' . $this->value . '.product');
	}

	/**
	 * Returns the unconverted EUR price for a regular purchase
	 */
	public function rawPrice(): float
	{
		return option('buy.' . $this->value . '.regular');
	}

	/**
	 * Returns the Paddle upgrade product ID
	 */
	public function upgradeId(bool $free = false): int
	{
		return match ($free) {
			true    => option('buy.' . $this->value . '.free'),
			default => option('buy.' . $this->value . '.upgrade')
		};
	}
}
