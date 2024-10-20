<?php

namespace Kirby\Buy;

use Kirby\Cms\App;
use Kirby\Toolkit\Str;
use MaxMind\Db\Reader;

class Visitor
{
	protected static string $ipCountry;

	/**
	 * Supported currencies with their currency sign (prefixed to the amount);
	 * currencies not listed here will automatically fall back to EUR
	 */
	public const CURRENCIES = [
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
		public readonly float|null $vatRate = null,
		public readonly string|null $country = null,
		public readonly bool $countryIsDetected = false,
		public readonly string|null $error = null
	) {
	}

	/**
	 * Creates a new instance (with validation)
	 *
	 * @param string $currency Currency code
	 * @param float $rate Currency conversion rate from EUR
	 * @param float|null $vatRate VAT rate for the country on top of the net price if available
	 * @param string|null $country Two-character ISO country code if available
	 * @param bool $countryIsDetected Whether the country code was detected from visitor IP address
	 * @param string|null $error Error message if an error occurred during currency detection
	 */
	public static function create(
		string $currency,
		float $rate,
		float|null $vatRate = null,
		string|null $country = null,
		bool $countryIsDetected = false,
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

		// cache the country info for 6 hours
		if ($error === null) {
			App::instance()->cache('getkirby.buy')->set('country/' . $country, compact('currency', 'rate', 'vatRate'), 360);
		}

		return new static($currency, $rate, $vatRate, $country, $countryIsDetected, $error);
	}

	/**
	 * Tries to retrieve visitor information for a country from cache
	 */
	public static function createFromCache(string $country, bool $countryIsDetected): static|null
	{
		$cache = App::instance()->cache('getkirby.buy')->get('country/' . $country);

		if (is_array($cache) === true) {
			$cache['country']           = $country;
			$cache['countryIsDetected'] = $countryIsDetected;

			return static::create(...$cache);
		}

		return null;
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
		$ip  = $env->get('REMOTE_ADDR', null);

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
	 * Determines the user country by their IP address
	 * @internal
	 */
	public static function ipCountry(): string|null
	{
		if (isset(static::$ipCountry) === true) {
			return static::$ipCountry;
		}

		$ip = static::ip();
		if ($ip === null) {
			return null;
		}

		$database = '/usr/share/GeoIP/GeoLite2-Country.mmdb';
		if (is_file($database) !== true) {
			return null;
		}

		try {
			$reader = new Reader($database);
			return static::$ipCountry = $reader->get($ip)['country']['iso_code'];
		} catch (\Throwable) {
			return null;
		}
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
	 * Returns the dynamic conversion rate from EUR based
	 * on the user currency adjusted with PPP information
	 */
	public function rateAdjusted(): float
	{
		$baseRate = $this->rate();
		$country  = $this->country();

		// we can't adjust if we don't know the target country
		if ($country === null) {
			return $baseRate;
		}

		$pppFactor = option('buy.pppFactors')[$country] ?? 1.0;

		// only adjust the rate if we got the country code from the user IP
		// except if the PPP factor is greater than 1 in a high-GDP country
		// (in which case circumventing the factor should not be possible)
		if ($this->countryIsDetected === false && $pppFactor < 1) {
			return $baseRate;
		}

		return $baseRate * $pppFactor;
	}

	/**
	 * Returns the formatted approximate revenue limit
	 * in the user's currency
	 *
	 * @param bool $verbose Whether to use long suffixes
	 */
	public function revenueLimit(bool $verbose = false): string
	{
		return RevenueLimit::approximation($this, $verbose);
	}

	/**
	 * Returns the VAT rate for the country on top
	 * of the net price if available
	 */
	public function vatRate(): float|null
	{
		return $this->vatRate;
	}
}
