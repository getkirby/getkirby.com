<?php

namespace Kirby\Buy;

use Kirby\Toolkit\Str;

class Passthrough
{
	public function __construct(
		public string|null $license = null,
		public array $discounts = [],
		public bool $gratitude = false,
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

		return new static(...json_decode($json, true));
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
			'gratitude'        => $this->gratitude,
			'multiplier'       => $this->multiplier,
			'newsletter'       => $this->newsletter,
			'partner'          => $this->partner,
			'customerDonation' => $this->customerDonation,
			'teamDonation'     => $this->teamDonation,
			'donationOrg'      => $this->donationOrg,
		]);
	}
}
