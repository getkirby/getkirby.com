<?php

namespace Kirby\Buy;

class RevenueLimit
{
	/**
	 * Returns the formatted approximate revenue limit,
	 * optionally in the user's currency
	 *
	 * @param bool $verbose Whether to use long suffixes
	 */
	public static function approximation(Visitor|null $visitor = null, bool $verbose = false): string
	{
		$value = static::value();

		if ($visitor !== null) {
			$value *= $visitor->rate();

			// remove the Paddle currency conversion fee
			// (not relevant for the revenue limit)
			$value /= 1 + $visitor->conversionFee();

			return '~ ' . $visitor->currencySign() . static::formatMagnitude($value, $verbose);
		}

		return '€' . static::formatMagnitude($value, $verbose);
	}

	/**
	 * Returns the raw Euro value
	 */
	public static function value(): int
	{
		return option('buy.revenueLimit');
	}

	/**
	 * Formats a number as approximate indicator of magnitude
	 *
	 * @param float $amount Number to format
	 * @param bool $verbose Whether to use long suffixes
	 */
	protected static function formatMagnitude(float $amount, bool $verbose = false): string
	{
		// shorten to three digits with K/M/B suffix
		$suffix = '';
		if ($amount >= 1000000000) {
			$amount /= 1000000000;
			$suffix = $verbose === true ? ' billion' : 'B';
		} elseif ($amount >= 1000000) {
			$amount /= 1000000;
			$suffix = $verbose === true ? ' million' : 'M';
		} elseif ($amount >= 1000) {
			$amount /= 1000;
			$suffix = $verbose === true ? ' thousand' : 'K';
		}

		// use two significant digits because it's just an approximation
		$digits = strlen(round($amount));
		$amount = round($amount, -$digits + 2);

		return $amount . $suffix;
	}
}
