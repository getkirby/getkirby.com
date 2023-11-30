<?php

namespace Buy;

use Exception;
use Kirby\Http\Remote;

class Paddle
{
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
}
