<?php

namespace Buy;

use Exception;
use Kirby\Cms\App;
use Kirby\Toolkit\Str;

class Visitor
{
	/**
	 * Supported currencies with their currency sign (prefixed to the amount);
	 * currencies not listed here will automatically fall back to EUR
	 */
	const CURRENCIES = [
		'ARS' => 'ARS ',
		'AUD' => 'A$',
		'BRL' => 'R$',
		'CAD' => 'CA$',
		'CHF' => 'CHF ',
		'CNY' => 'CN¥',
		'COP' => 'COP ',
		'CZK' => 'Kč ',
		'DKK' => 'kr ',
		'EUR' => '€',
		'GBP' => '£',
		'HKD' => 'HK$',
		'HUF' => 'Ft ',
		'ILS' => '₪',
		'INR' => '₹',
		'JPY' => '¥',
		'KRW' => '₩',
		'MXN' => 'MX$',
		'NOK' => 'kr ',
		'NZD' => 'NZ$',
		'PLN' => 'zł ',
		'SEK' => 'kr ',
		'SGD' => 'SGD ',
		'THB' => '฿',
		'TRY' => '₺',
		'TWD' => 'NT$',
		'UAH' => '₴',
		'USD' => '$',
		'ZAR' => 'R ',
	];

	protected function __construct(
		public readonly string $currency,
		public readonly float $rate,
		public readonly string|null $country = null,
		public readonly string|null $error = null
	) {
	}

	/**
	 * Creates a new instance (with validation)
	 *
	 * @param string $currency Currency code
	 * @param float $rate Currency conversion rate from EUR
	 * @param string|null $country Two-character ISO country code if available
	 * @param string|null $error Error message if an error occurred during currency detection
	 */
	public static function create(
		string $currency,
		float $rate,
		string|null $country = null,
		string|null $error = null
	): static {
		// fall back to EUR if the detected visitor currency is not supported
		if (isset(static::CURRENCIES[$currency]) !== true) {
			$error    = 'Invalid currency "' . $currency . '"';
			$currency = 'EUR';
			$rate     = 1.0;
		}

		// the conversion rate of EUR always needs to be 1
		if ($currency === 'EUR' && $rate !== 1.0) {
			$rate  = 1.0;
			$error = 'Invalid conversion rate "' . $rate . '" for currency EUR';
		}

		return new static($currency, $rate, $country, $error);
	}

	/**
	 * Creates a fallback EUR instance if an error occurred
	 * during currency detection
	 */
	public static function createFromError(string $error): static
	{
		return static::create(
			currency: 'EUR',
			rate: 1.0,
			error: $error
		);
	}

	/**
	 * Returns the user's two-character ISO country code if available
	 */
	public function country(): string|null
	{
		return $this->country;
	}

	/**
	 * Returns the currency code chosen for the user
	 */
	public function currency(): string
	{
		return $this->currency;
	}

	/**
	 * Returns the currency sign prefix chosen for the user
	 */
	public function currencySign(): string
	{
		return static::CURRENCIES[$this->currency];
	}

	/**
	 * Return the error that occurred during currency detection
	 * if there was one
	 */
	public function error(): string|null
	{
		return $this->error;
	}

	/**
	 * Determines the user IP address depending on the setup
	 * @internal
	 */
	public static function ip(): string|null
	{
		$env = App::instance()->environment();

		// if the site is served via Cloudflare, use the proxied IP header
		if (option('cloudflare', false) === true) {
			return $env->get('HTTP_CF_CONNECTING_IP', null);
		}

		// otherwise use the direct IP header
		$ip = $env->get('REMOTE_ADDR', null);

		// ignore local IPs as we cannot determine the country from them
		if (
			$ip === null ||
			$ip === '::1' ||
			Str::startsWith($ip, '0.') === true ||
			Str::startsWith($ip, '10.') === true ||
			Str::startsWith($ip, '127.') === true ||
			Str::startsWith($ip, '192.') === true ||
			Str::startsWith($ip, 'fe80::') === true
		) {
			return null;
		}

		return $ip;
	}

	/**
	 * Returns the dynamic conversion rate from EUR based
	 * on the chosen user currency
	 */
	public function rate(): float
	{
		return $this->rate;
	}

	/**
	 * Returns the formatted approximate revenue limit
	 * in the user's currency
	 *
	 * @param int $revenueLimit Limit in EUR to convert
	 */
	public function revenueLimit(int $revenueLimit): string
	{
		$converted = $revenueLimit * $this->rate;

		// shorten to three digits with K/M/B suffix
		$suffix = '';
		if ($converted >= 1000000000) {
			$converted /= 1000000000;
			$suffix = 'B';
		} elseif ($converted >= 1000000) {
			$converted /= 1000000;
			$suffix = 'M';
		} elseif ($converted >= 1000) {
			$converted /= 1000;
			$suffix = 'K';
		}

		// use two significant digits because it's just an approximation
		$digits    = strlen(round($converted));
		$converted = round($converted, -$digits + 2);

		return '~ ' . $this->currencySign() . $converted . $suffix;
	}
}
