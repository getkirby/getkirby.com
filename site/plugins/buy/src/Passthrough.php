<?php

namespace Kirby\Buy;

use Kirby\Reflection\Constructor;
use Kirby\Toolkit\Str;

/**
 * Helper class to handle Paddle passthrough data
 */
class Passthrough
{
	public function __construct(
		public string|null $license = null,
		public array $discounts = [],
		public int $multiplier = 1,
		public bool $newsletter = false,
		public string|null $partner = null,
		public int $customerDonation = 0,
		public int $teamDonation = 0,
		public string|null $donationOrg = null,
	) {
	}

	/**
	 * Normalizes a passthrough value to a class instance
	 */
	public static function factory(string|Passthrough|null $passthrough): static
	{
		if (is_string($passthrough) === true) {
			return static::fromJson($passthrough);
		}

		return $passthrough ?? new static();
	}

	/**
	 * Parses a passthrough string from a Paddle webhook
	 */
	public static function fromJson(string $json): static
	{
		if ($json === '') {
			return new static();
		}

		if (Str::startsWith($json, '{') === false) {
			// just a license string
			return new static(license: $json);
		}

		$data = json_decode($json, true);

		if (is_array($data) === false) {
			return new static();
		}

		// drop unknown properties; Paddle sends back the passthrough
		// that was stored when the checkout was created, so it can
		// still contain properties that have been removed since then
		$data = (new Constructor(static::class))->getAcceptedArguments($data);

		return new static(...$data);
	}

	/**
	 * Converts the passthrough to a JSON string
	 * for the Paddle checkout request
	 */
	public function toJson(): string
	{
		return json_encode([
			'license'          => $this->license,
			'discounts'        => $this->discounts,
			'multiplier'       => $this->multiplier,
			'newsletter'       => $this->newsletter,
			'partner'          => $this->partner,
			'customerDonation' => $this->customerDonation,
			'teamDonation'     => $this->teamDonation,
			'donationOrg'      => $this->donationOrg,
		]);
	}
}
