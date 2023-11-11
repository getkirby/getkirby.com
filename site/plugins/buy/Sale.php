<?php

namespace Buy;


class Sale
{
	public readonly string $start;
	public readonly string $end;
	public readonly float $factor;

	public function __construct()
	{
		$this->start  = option('buy.sale.start', '1970-01-01');
		$this->end    = option('buy.sale.end', '1970-01-01');
		$this->factor = option('buy.sale.factor', 1);
	}

	public function factor(): float
	{
		if ($this->isActive() === true) {
			return $this->factor;
		}

		return 1;
	}

	public function isActive(): bool
	{
		$now = time();
		return $now >= strtotime($this->start) && $now <= strtotime($this->end);
	}

	public function percentage(): int
	{
		return round((1 - $this->factor()) * 100);
	}
}
