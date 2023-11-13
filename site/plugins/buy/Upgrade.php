<?php

namespace Buy;

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
			option('buy.' . $this->price->product->value . '.min')
		);
	}

	/**
	 * Gets the default price for the upgrade
	 */
	public function default(): int
	{
		return $this->price->convert(
			option('buy.' . $this->price->product->value . '.nudge')
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
