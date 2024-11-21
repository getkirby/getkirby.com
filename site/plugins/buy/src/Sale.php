<?php

namespace Kirby\Buy;

use DateTime;
use DateTimeZone;

class Sale
{
	public readonly int $start;
	public readonly int $end;
	public readonly int $discount;
	protected static int $time;

	public function __construct()
	{
		$options = option('buy.sale', []);

		// ensure that all calls to methods of this class base their logic on the
		// same timestamp to avoid off-by-one errors in the second of a date change
		static::$time ??= time();

		// calculate timestamps in UTC,
		// even if the server uses a different timezone
		$this->start    = strtotime(($options['start'] ?? '1970-01-01') . ' 00:00Z');
		$this->end      = strtotime(($options['end'] ?? '1970-01-01') . ' 24:00Z');
		$this->discount = $options['discount'] ?? 0;
	}

	/**
	 * Returns the current sale discount (0 = no sale / 100 = for free)
	 */
	public function discount(): int
	{
		return $this->isActive() ? $this->discount : 0;
	}

	/**
	 * Returns the end date as formatted string
	 */
	public function ends(): string
	{
		if ($this->end - static::$time <= 24 * 60 * 60) {
			return '<strong>today</strong> (midnight UTC)';
		}

		// ensure to always display the date in UTC
		// to avoid wrong dates in wrong server time zones
		$dateTime = new DateTime();
		$dateTime->setTimezone(new DateTimeZone('UTC'));

		// the end date is the midnight of the next day,
		// subtract one second to show the correct date
		$dateTime->setTimestamp($this->end - 1);

		return $dateTime->format('M jS');
	}

	/**
	 * Sets the cache expiration date
	 * to make sure the sale banner is updated and not
	 * cached beyond the end of sale
	 */
	public function expires(): void
	{
		$expires = [];

		// the cache will expire once the sale will start
		if ($this->start > static::$time) {
			$expires[] = $this->start;
		}

		// if a banner is currently active, the cache
		// will also expire when the active banner ends
		if ($this->isActive() === true) {
			// expire one day before the end date,
			// so the text can change on the last day
			if ($this->end - static::$time > 24 * 60 * 60) {
				$expires[] = $this->end - 24 * 60 * 60;
			}

			// in any case throw away the cache when the
			// sale has ended to remove the banners
			$expires[] = $this->end;
		}

		if (empty($expires) === true) {
			return;
		}

		// expire the cache on the next opportunity
		$timestamp = min($expires);
		kirby()->response()->expires($timestamp);
		kirby()->response()->header('Expires', gmdate('D, d M Y H:i:s T', $timestamp));
	}

	/**
	 * Whether Kirby is currently in a sale
	 */
	public function isActive(): bool
	{
		return static::$time >= $this->start && static::$time < $this->end;
	}

	/**
	 * Returns the text for the sale banner
	 */
	public function text(): string
	{
		return '🛍 &nbsp; <strong>Save  ' . $this->discount() . '%</strong> until ' . $this->ends();
	}
}
