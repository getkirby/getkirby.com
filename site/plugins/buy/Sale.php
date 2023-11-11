<?php

namespace Buy;


class Sale
{
	public readonly string $start;
	public readonly string $end;
	public readonly float $factor;

	public function __construct()
	{
		$options = option('buy.sale', []);
		$this->start  = strtotime($options['start'] ?? '1970-01-01');
		// the end date is inclusive, add one day
		$this->end    = strtotime($options['end'] ?? '1970-01-01') + 86400;
		$this->factor = $options['factor'] ?? 1;
	}

	/**
	 * Returns the end date as formatted string
	 */
	public function ends(): string
	{
		return match (true) {
			$this->end - time() < 24 * 60 * 60
				=> '<strong>today</strong> (midnight UTC)',
			default
				=> date('M jS', $this->end),
		};
	}

	/**
	 * Sets the cache expiration date
	 * to make sure the sale banner is updated and not
	 * cached beyond the end of sale
	 */
	public function expires(): void
	{
		$expires = null;

		// the cache will expire once the sale will start
		if ($this->start > time()) {
			$expires = $this->start;
		}

		// if a banner is currently active, the cache
		// will also expire when the active banner ends
		if ($this->isActive() === true) {
			// expire one day before the end date,
			// so the text can change on the last day
			$end     = $this->end - 24 * 60 * 60;
			$expires = match ($expires) {
				null    => $end,
				default => min($expires, $end),
			};
		}

		kirby()->response()->expires($expires);
	}

	/**
	 * Returns the current sale factor (1 = no sale)
	 */
	public function factor(): float
	{
		return $this->isActive() ? $this->factor : 1;
	}

	/**
	 * Wheether Kirby is currently in a sale
	 */
	public function isActive(): bool
	{
		return time() >= $this->start && time() <= $this->end;
	}

	/**
	 * Returns the percentage of the current sale (0-100, without %)
	 */
	public function percentage(): int
	{
		return round((1 - $this->factor()) * 100);
	}

	/**
	 * Returns the text for the sale banner
	 */
	public function text(): string
	{
		return '🛍 &nbsp; <strong>Save  '. $this->percentage() . '%</strong> until ' . $this->ends();
	}
}
