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

		$response = static::request('POST', 'vendors', 'product/generate_pay_link', compact('data'));
		return $response['url'];
	}

	/**
	 * Performs a request to the Paddle API
	 *
	 * @param 'GET'|'POST' $method HTTP method
	 *
	 * @throws \Exception On request errors or Paddle API errors
	 */
	public static function request(string $method, string $subdomain, string $endpoint, array $options = []): array
	{
		// GET requests need the data as query params
		$method = strtoupper($method);
		$query  = '';
		if ($method === 'GET' && isset($options['data']) === true) {
			$query = '?' . http_build_query($options['data']);
		}

		$response = new Remote(
			'https://' . $subdomain . '.paddle.com/api/2.0/' . $endpoint . $query,
			[
				'method' => $method,
				...$options
			]
		);

		$data = $response->json();

		if (isset($data['success']) === true && $data['success'] === true) {
			return $data['response'];
		}

		throw new Exception($data['error']['message'] ?? 'Unknown error');
	}

	/**
	 * Determines the country, currency and conversion rate information
	 * for the visitor via the Paddle price API
	 *
	 * @param string|null $country Override for a country code (used for testing)
	 */
	public static function visitor(string|null $country = null): Visitor
	{
		// cache for the entire request as the IP won't change
		if (isset(static::$visitor) === true) {
			return static::$visitor;
		}

		try {
			$product = Product::Basic;

			$options = [
				'data' => [
					'product_ids' => $product->productId()
				],

				// fast timeout to avoid letting the user wait too long
				'timeout' => 1
			];

			if ($country !== null) {
				$options['data']['customer_country'] = $country;
			} else {
				$ip = Visitor::ip();

				// if we only have a local IP, don't bother
				// requesting dynamic information from Paddle
				if ($ip === null) {
					return static::$visitor = Visitor::createFromError('No visitor IP available');
				}

				$options['data']['customer_ip'] = $ip;
			}

			$response      = static::request('GET', 'checkout', 'prices', $options);
			$paddleProduct = $response['products'][0];

			return static::$visitor = Visitor::create(
				country: $response['customer_country'],
				currency: $paddleProduct['currency'],

				// calculate conversion rate from the EUR price;
				// requires that the EUR price matches between the site and Paddle admin
				conversionRate: $paddleProduct['list_price']['net'] / $product->rawPrice()
			);
		} catch (Throwable $e) {
			// on any kind of error, use the EUR prices as a fallback
			// to avoid a broken buy page
			return static::$visitor = Visitor::createFromError($e->getMessage());
		}
	}
}
