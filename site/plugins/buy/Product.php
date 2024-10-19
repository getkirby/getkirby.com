<?php

namespace Buy;

enum Product: string
{
	case Basic            = 'basic';
	case Enterprise       = 'enterprise';
	case PartnerCertified = 'partner-certified';
	case PartnerRegular   = 'partner-regular';

	/**
	 * Checks whether the product is eligible
	 * for PPP price adjustment
	 */
	public function adjustForPPP(): bool
	{
		return match ($this) {
			static::Enterprise => false,
			default            => true
		};
	}

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
			'convert' => $this->upgradeId('convert'),
			'free'    => $this->upgradeId('free'),
		};

		return Paddle::checkout($product, $payload);
	}

	/**
	 * Returns the human-readable label for the buy page
	 */
	public function label(): string
	{
		return match ($this) {
			static::Basic            => 'Basic',
			static::Enterprise       => 'Enterprise',
			static::PartnerCertified => 'Certified partnership',
			static::PartnerRegular   => 'Regular partnership',
			default                  => null
		};
	}

	/**
	 * Returns the price object for the product
	 */
	public function price(string|null $currency = null, float|null $rate = null): Price
	{
		return new Price($this, $currency, $rate);
	}

	/**
	 * Returns the Paddle product ID
	 */
	public function productId(): int
	{
		return option('buy.products.' . $this->value . '.product');
	}

	/**
	 * Returns the unconverted EUR price for a regular purchase
	 */
	public function rawPrice(): float
	{
		return option('buy.products.' . $this->value . '.regular');
	}

	/**
	 * Ensures that the quantity is in the valid range
	 */
	public static function restrictQuantity(int $quantity): int
	{
		$quantity = max($quantity, option('buy.quantities.min'));
		return min($quantity, option('buy.quantities.max'));
	}

	/**
	 * Returns a label for the revenue limit
	 */
	public function revenueLimit(): string|null
	{
		return match ($this) {
			static::Basic      => 'Revenue limit: ' . RevenueLimit::approximation() . ' / year.',
			static::Enterprise => 'This license does not have a revenue limit.',
			default            => null
		};
	}

	/**
	 * Returns the Paddle upgrade product ID
	 */
	public function upgradeId(string|null $type = null): int
	{
		return match ($type) {
			'free'    => option('buy.products.' . $this->value . '.free'),
			'convert' => option('buy.products.' . $this->value . '.convert'),
			default   => option('buy.products.' . $this->value . '.upgrade')
		};
	}

	/**
	 * Returns the machine-readable enum value
	 */
	public function value(): string
	{
		return $this->value;
	}

}
