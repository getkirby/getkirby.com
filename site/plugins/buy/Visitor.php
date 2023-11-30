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
		'ARS' => 'ARS ',
		'AUD' => 'A$',
		'BRL' => 'R$',
		'CAD' => 'CA$',
		'CHF' => 'CHF ',
		'CNY' => 'CN¥',
		'COP' => 'COP ',
		'CZK' => 'CZK ',
		'DKK' => 'DKK ',
		'EUR' => '€',
		'GBP' => '£',
		'HKD' => 'HK$',
		'HUF' => 'HUF ',
		'ILS' => '₪',
		'INR' => '₹',
		'JPY' => '¥',
		'KRW' => '₩',
		'MXN' => 'MX$',
		'NOK' => 'NOK ',
		'NZD' => 'NZ$',
		'PLN' => 'PLN ',
		'SEK' => 'SEK ',
		'SGD' => 'SGD ',
		'THB' => 'THB ',
		'TRY' => 'TRY ',
		'TWD' => 'NT$',
		'UAH' => 'UAH ',
		'USD' => '$',
		'ZAR' => 'ZAR ',
	];

	protected function __construct(
		protected string $currency,
		protected float $conversionRate,
		protected string|null $country = null,
		protected string|null $error = null
	) {
	}

	/**
	 * Creates a new instance (with validation)
	 *
	 * @param string $currency Currency code
	 * @param float $conversionRate Currency conversion rate from EUR
	 * @param string|null $country Two-character ISO country code if available
	 * @param string|null $error Error message if an error occurred during currency detection
	 */
	public static function create(
		string $currency,
		float $conversionRate,
		string|null $country = null,
		string|null $error = null
	): static {
		// fall back to EUR if the user currency is not supported
		if (isset(static::CURRENCIES[$currency]) !== true) {
			$error          = 'Invalid currency "' . $currency . '"';
			$currency       = 'EUR';
			$conversionRate = 1.0;
		}

		// the conversion rate of EUR always needs to be 1
		if ($currency === 'EUR' && $conversionRate !== 1.0) {
			$conversionRate = 1.0;
			$error          = 'Invalid conversion rate "' . $conversionRate . '" for currency EUR';
		}

		return new static($currency, $conversionRate, $country, $error);
	}

	/**
	 * Creates a fallback EUR instance if an error occurred
	 * during currency detection
	 */
	public static function createFromError(string $error): static
	{
		return static::create(
			currency: 'EUR',
			conversionRate: 1.0,
			error: $error
		);
	}

	/**
	 * Returns the dynamic conversion rate from EUR based
	 * on the chosen user currency
	 */
	public function conversionRate(): float
	{
		return $this->conversionRate;
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
	 * If there was an error during currency detection,
	 * it will be returned here
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
		$ip = $env->get('REMOTE_ADDR', '');

		// ignore local IPs as we cannot determine the country from them
		if (
			Str::startsWith($ip, '0.') === true ||
			Str::startsWith($ip, '10.') === true ||
			Str::startsWith($ip, '127.') === true ||
			Str::startsWith($ip, '192.') === true ||
			Str::startsWith($ip, 'fe80::') === true ||
			$ip === '::1'
		) {
			return null;
		}

		return $ip;
	}

	/**
	 * Returns the formatted approximate revenue limit
	 * in the user's currency
	 *
	 * @param int $revenueLimit Limit in EUR to convert
	 */
	public function revenueLimit(int $revenueLimit): string
	{
		$converted = $revenueLimit * $this->conversionRate;

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

		return '~ ' . $this->currencySign() . $converted . $suffix;
	}
}
