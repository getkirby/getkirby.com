<?php

namespace Buy;

use Exception;
use Kirby\Http\Remote;

enum Product: string
{
	case Basic 	    = 'basic';
	case Enterprise = 'enterprise';

	/**
	 * Generates a checkout link for the product
	 */
	public function checkout(array $payload): string {
		$data   = [
			'vendor_id'         => option('keys.paddle.id'),
			'vendor_auth_code'  => option('keys.paddle.auth'),
			'product_id'        => $this->id(),
			'expires'           => date('Y-m-d', strtotime('+1 day')),
			'quantity_variable' => false,
			'quantity'          => 1,
			...$payload
		];

		$response = Remote::post(
			'https://vendors.paddle.com/api/2.0/product/generate_pay_link',
			['data' => $data]
		);
		$data = $response->json(false);

		if ($data->success) {
			return $data->response->url;
		}

		throw new Exception($data->error->message);
	}

	/**
	 * Returns the Paddle product ID
	 */
	public function id(): int
    {
		return option('buy.' . $this->value . '.id');
    }

	/**
	 * Returns the price object for the product
	 */
	public function price(string $currency = 'EUR'): Price
    {
        return new Price($this , $currency);
    }
}
