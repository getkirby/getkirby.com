<?php

namespace Kirby\Buy;

use Exception;
use Kirby\Http\Remote;
use Throwable;

class Paddle
{
	// hardcoded config last updated 2025-01-02

	/**
	 * Currency conversion fees to EUR
	 * https://www.paddle.com/legal/terms#:~:text=foreign%20exchange%20margin
	 */
	public const CONVERSION_FEES = [
		'USD' => 0.02,
		'GBP' => 0.02,
		'CZK' => 0.025,
		'DKK' => 0.025,
		'NOK' => 0.025,
		'THB' => 0.025,

		// all other currencies
		'...' => 0.03
	];

	/**
	 * All supported countries
	 * https://developer.paddle.com/classic/reference/29717a4e58630-supported-countries
	 */
	public const COUNTRIES = [
		'AX' => 'Aland Islands',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AG' => 'Antigua and Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BQ' => 'Bonaire, Sint Eustatius and Saba',
		'BA' => 'Bosnia and Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'Brit. Indian Ocean',
		'VG' => 'British Virgin Islands',
		'BN' => 'Brunei',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'CI' => 'Cote D’Ivoire',
		'HR' => 'Croatia',
		'CW' => 'Curaçao',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Terr.',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HM' => 'Heard/ Mcdonald Islands',
		'VA' => 'Holy See/ Vatican City',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IM' => 'Isle of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'XK' => 'Kosovo',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Lao People’s DR',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'AN' => 'Netherlands Antilles',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PS' => 'Palestinian Territory',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'CG' => 'Republic of Congo',
		'RS' => 'Republic of Serbia',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RW' => 'Rwanda',
		'GS' => 'S. Georgia/ Sandwich Islands',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint Lucia',
		'MF' => 'Saint Martin',
		'PM' => 'Saint Pierre and Miquelon',
		'VC' => 'Saint Vincent/ Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome and Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'ZA' => 'South Africa',
		'KR' => 'South Korea',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard and Jan Mayen',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'VI' => 'U.S. Virgin Islands',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UM' => 'United States (M.O.I.)',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VN' => 'Vietnam',
		'WF' => 'Wallis and Futuna',
		'EH' => 'Western Sahara',
		'ZM' => 'Zambia',
	];

	/**
	 * Countries that require a postal code
	 * https://developer.paddle.com/classic/reference/29717a4e58630-supported-countries#countries-requiring-postcode
	 */
	public const COUNTRIES_WITH_POSTAL_CODE = [
		'AU',
		'CA',
		'FR',
		'DE',
		'IN',
		'IT',
		'NL',
		'ES',
		'GB',
		'US',
	];

	/**
	 * Supported currencies with their currency sign (prefixed to the amount);
	 * currencies not listed here will automatically fall back to EUR
	 * https://developer.paddle.com/classic/reference/08d5d797e10ae-supported-currencies
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
		// 'RUB' => '₽',
		'SEK' => 'kr ',
		'SGD' => 'SGD ',
		'THB' => '฿',
		'TRY' => '₺',
		'TWD' => 'NT$',
		'UAH' => '₴',
		'USD' => '$',
		'ZAR' => 'R ',
	];

	/**
	 * Currencies that don't use 2 decimal places but a different number
	 * https://developer.paddle.com/classic/reference/08d5d797e10ae-supported-currencies
	 */
	public const CURRENCIES_WITH_CUSTOM_DECIMALS = [
		'JPY' => 0,
		'KRW' => 0,
	];

	// cache
	protected static Visitor $visitor;

	/**
	 * Generates a custom checkout link and returns the checkout URL
	 *
	 * @throws \Exception On request errors or Paddle API errors
	 */
	public static function checkout(string $product, array $payload = []): string
	{
		$data = [
			'vendor_id'         => option('keys.paddle.id'),
			'vendor_auth_code'  => option('keys.paddle.auth'),
			'product_id'        => $product,
			'expires'           => date('Y-m-d', strtotime('+1 day')),
			'quantity_variable' => false,
			'quantity'          => 1,
			'discountable'      => (new Sale)->isActive() ? 0 : 1,
			...$payload
		];

		// normalize the passthrough param to a JSON string
		$data['passthrough'] = Passthrough::factory($data['passthrough'] ?? null)->toJson();

		$response = static::request(
			endpoint: 'product/generate_pay_link',
			method: 'POST',
			options: compact('data')
		);

		return $response['url'];
	}

	/**
	 * Performs a request to the Paddle API
	 *
	 * @param 'GET'|'POST' $method HTTP method
	 *
	 * @throws \Exception On request errors or Paddle API errors
	 */
	public static function request(
		string $endpoint,
		string $method,
		string $subdomain = 'vendors',
		array $options = []
	): array {
		$url = 'https://' . $subdomain . '.paddle.com/api/2.0/' . $endpoint;

		// GET requests need the data as query params
		$method = strtoupper($method);
		if ($method === 'GET' && isset($options['data']) === true) {
			$url .= '?' . http_build_query($options['data']);
		}

		$response = new Remote($url, ['method' => $method, ...$options]);
		$data     = $response->json();

		if (($data['success'] ?? null) === true) {
			return $data['response'];
		}

		throw new Exception($data['error']['message'] ?? 'Unknown error');
	}

	/**
	 * Determines the country, currency and conversion rate information
	 * for the visitor via the Paddle price API
	 *
	 * @param string|null $country Override for a country code
	 */
	public static function visitor(string|null $country = null): Visitor
	{
		// cache for the entire request as the IP won't change
		if (isset(static::$visitor) === true) {
			return static::$visitor;
		}

		$detectedCountry   = Visitor::ipCountry();
		$queryCountry      = $country ?? $detectedCountry;
		$countryIsDetected = $detectedCountry === $queryCountry;

		// if we only have a local IP or something went wrong,
		// don't bother requesting localized pricing from Paddle
		if ($queryCountry === null) {
			return static::$visitor = Visitor::createFromError('No visitor country detected');
		}

		// try to load from persistent cache
		if ($cache = Visitor::createFromCache($queryCountry, $countryIsDetected)) {
			return static::$visitor = $cache;
		}

		try {
			$product = Product::Basic;

			$options = [
				'data' => [
					'customer_country' => $queryCountry,
					'product_ids'      => $product->productId()
				],

				// fast timeout to avoid letting the user wait too long
				'timeout' => 1
			];

			$response = static::request(
				endpoint: 'prices',
				method: 'GET',
				subdomain: 'checkout',
				options: $options
			);

			$paddleProduct = $response['products'][0];

			return static::$visitor = Visitor::create(
				country: $response['customer_country'],
				countryIsDetected: $countryIsDetected,
				currency: $paddleProduct['currency'],

				// calculate conversion rate from the EUR price;
				// requires that the EUR price matches between the site and Paddle admin
				rate: $paddleProduct['list_price']['net'] / $product->rawPrice(),

				// calculate VAT rate, rounded to four decimal places to avoid float mishaps
				vatRate: round($paddleProduct['list_price']['tax'] / $paddleProduct['list_price']['net'] * 10000) / 10000,
			);
		} catch (Throwable $e) {
			// on any kind of error, use the EUR prices as a fallback
			// to avoid a broken buy page and checkout
			return static::$visitor = Visitor::createFromError($e->getMessage());
		}
	}
}
