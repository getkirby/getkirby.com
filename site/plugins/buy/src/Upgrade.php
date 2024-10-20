<?php

namespace Kirby\Buy;

class Upgrade
{
	public function __construct(
		public readonly Price $price
	) {
	}

	/**
	 * Gets the minimum price for the upgrade
	 */
	public function min(): int
	{
		return $this->price->convert(
			option('buy.products.' . $this->price->product->value . '.min'),
			adjust: $this->price->product->adjustForPPP()
		);
	}

	/**
	 * Gets the default price for the upgrade
	 */
	public function default(): int
	{
		return $this->price->convert(
			option('buy.products.' . $this->price->product->value . '.nudge'),
			adjust: $this->price->product->adjustForPPP()
		);
	}

	/**
	 * Gets the maximum price for the upgrade
	 */
	public function max(): int
	{
		return $this->price->regular();
	}

	public function toArray(): array
	{
		return [
			'min'     => $this->min(),
			'default' => $this->default(),
			'max'     => $this->max()
		];
	}
}
