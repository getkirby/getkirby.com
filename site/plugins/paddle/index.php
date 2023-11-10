<?php

namespace Kirby\Paddle;

use Kirby\Http\Remote;
use Kirby\Http\Visitor;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Exception\NotFoundException;

class Checkout
{
	protected $country;
	protected $discount;
	protected $discounts;
	protected $product;
	protected $sale;
	protected $vendorAuthCode;
	protected $vendorId;
	protected $volumes;

	/**
	 * @param array $options
	 */
	public function __construct(array $options = [])
	{
		$options = array_merge(option('paddle'), $options);

		if (empty($options['product']) === true) {
			throw new InvalidArgumentException('Please provide a product ID');
		}

		$this->discounts      = $options['discounts'] ?? [];
		$this->product        = $options['product'];
		$this->sale           = $options['sale'] ?? false;
		$this->vendorAuthCode = $options['vendorAuthCode'] ?? option('keys.paddle.auth');
		$this->vendorId       = $options['vendorId'] ?? option('keys.paddle.id');
		$this->volumes        = array_keys($this->discounts);

	}

	/**
	 * Returns all available discounts
	 */
	public function discounts(): array
	{
		return $this->discounts;
	}

	/**
	 * Returns price info based on the country
	 * code or the IP address
	 */
	public function info(string $country = null): array
	{
		$query = [
			'product_ids' => $this->product,
		];

		if ($country === null) {
			$query['customer_ip'] = (new Visitor)->ip();
		} else {
			$query['customer_country'] = $country;
		}

		$response = Remote::get('https://checkout.paddle.com/api/2.0/prices', [
			'data' => $query
		]);

		if ($response->code() !== 200) {
			throw new NotFoundException('The prices could not be loaded');
		}

		$data = $response->json();

		if (empty($data['response']['products'][0]) === true) {
			throw new NotFoundException('The product price could not be loaded');
		}

		$product  = $data['response']['products'][0];
		$price    = floatval($product['price']['net']);
		$currency = $product['currency'];

		return [
			'currency' => $currency,
			'price'    => $price,
		];
	}

	/**
	 * Returns the product id
	 */
	public function product(): int
	{
		return $this->product;
	}

	/**
	 * Calculates the net total discount price
	 */
	public function total(float $unit, int $volume, int $discount): float
	{
		$price     = $unit * ((100 - $discount) / 100) * $volume;
		$nicePrice = floor($price / 5) * 5;

		return $nicePrice / $volume;
	}

	/**
	 * Creates a redirect URL for a custom volume discount checkout
	 */
	public function url(int $volume, string $country = null): string
	{
		if (in_array($volume, $this->volumes) === false) {
			throw new InvalidArgumentException('The given volume package is not available');
		}

		$discount = $this->discounts[$volume];
		$info     = $this->info();
		$currency = $info['currency'];
		$price    = $info['price'];
		$prices   = [$currency . ':' . $this->total($price, $volume, $discount)];

		// If the currency is different from product's base currency (EUR),
		// the base currency price must be included as well
		if ($currency !== 'EUR') {
			$prices[] = 'EUR:' . $this->total($this->info('DE')['price'], $volume, $discount);
		}

		$data = [
			'vendor_id'         => $this->vendorId,
			'vendor_auth_code'  => $this->vendorAuthCode,
			'product_id'        => $this->product,
			'quantity'          => $volume,
			'quantity_variable' => false,
			'prices'            => $prices,
			//'custom_message'  => $discount . '% off standard price!'
		];

		$response = Remote::post(
			'https://vendors.paddle.com/api/2.0/product/generate_pay_link',
			[
				'data' => $data
			]
		);

		$json = $response->json();
		$url  = $json['response']['url'] ?? null;

		if ($response->code() !== 200 || empty($url) === true) {
			throw new NotFoundException('The checkout link could not be created');
		}

		return $url;
	}

}
