<?php

namespace Buy;

use Exception;
use Kirby\Http\Remote;
use Throwable;

class Paddle
{
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

		$detectedCountry = Visitor::ipCountry();
		$queryCountry    = $country ?? $detectedCountry;

		// if we only have a local IP or something went wrong,
		// don't bother requesting localized pricing from Paddle
		if ($queryCountry === null) {
			return static::$visitor = Visitor::createFromError('No visitor country detected');
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
				countryIsDetected: $country === null || $country === $detectedCountry,
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
