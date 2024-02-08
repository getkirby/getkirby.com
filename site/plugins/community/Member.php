<?php

namespace Kirby\Community;

use Kirby\Data\Data;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Github\Github;
use Kirby\Http\Remote;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;
use Kirby\Uuid\Uuid;

class Member
{
	protected string $pr;
	public static string $repo = 'getkirby/playground-meet-api';

	public function __construct(
		protected string $uuid,
		protected string $slug,
		protected string $name,
		protected string $place,
		protected string $country,
		protected float $latitude,
		protected float $longitude,
		protected string|null $business = null,
		protected string|null $forum = null,
		protected string|null $github = null,
		protected string|null $discord = null,
		protected string|null $instagram = null,
		protected string|null $mastodon = null,
		protected string|null $linkedin = null,
	) {
	}

	public function content(): array
	{
		return [
			'uuid'      => $this->uuid,
			'name'      => $this->name,
			'place'     => $this->place,
			'country'   => $this->country,
			'latitude'  => $this->latitude,
			'longitude' => $this->longitude,
			'business'  => $this->business,
			'forum'     => $this->forum,
			'github'    => $this->github,
			'discord'   => $this->discord,
			'instagram' => $this->instagram,
			'mastodon'  => $this->mastodon,
			'linkedin'  => $this->linkedin,
		];
	}

	public static function create(
		string $name,
		string $place,
		string $country,
		string|null $business = null,
		string|null $forum = null,
		string|null $github = null,
		string|null $discord = null,
		string|null $instagram = null,
		string|null $mastodon = null,
		string|null $linkedin = null,
	): static {
		// normalize the instagram handle
		if ($instagram !== null) {
			$instagram = ltrim($instagram, '@');
		}

		static::validate(...func_get_args());

		// find latitude and longitude for the member
		$location = static::locate($place, $country);

		// create a unique slug for the member
		$uuid = Uuid::generate();
		$slug = Str::slug($name) . '-' . $uuid;

		// create a new member object to work with
		$member = new static(
			uuid: $uuid,
			slug: $slug,
			name: $name,
			place: $place,
			country: $country,
			latitude: $location['latitude'],
			longitude: $location['longitude'],
			business: $business,
			forum: $forum,
			github: $github,
			discord: $discord,
			instagram: $instagram,
			mastodon: $mastodon,
			linkedin: $linkedin,
		);

		// submit the PR for the new member
		$member->submit();

		return $member;
	}

	public static function countries(): array
	{
		return kirby()->option('countries');
	}

	public static function locate(string $place, string $country): array
	{
		$mapbox	  = kirby()->option('keys.mapbox');
		$address  = urlencode($place . ', ' . $country);
		$response = Remote::get("https://api.mapbox.com/geocoding/v5/mapbox.places/$address.json?access_token=" . $mapbox);

		if ($response->code() !== 200) {
			throw new InvalidArgumentException('Could not find the location');
		}

		[$longitude, $latitude] = $response->json()['features'][0]['center'];

		return [
			'latitude'  => $latitude,
			'longitude' => $longitude
		];
	}

	public function pr(): string
	{
		return $this->pr;
	}

	/**
	 * Creates the PR for the new member
	 */
	public function submit(): bool
	{
		// create a new unique branch
		$branch = Github::createBranch(static::$repo, 'meet/' . $this->slug . '-' . time());

		// create the content for the new member
		$content = Data::encode($this->content(), 'txt');

		// create a new commit with the file
		Github::createFile(
			static::$repo,
			'content/meet/contact/' . $this->slug . '/meet-contact.txt',
			$content,
			$branch = $branch->json()['ref'],
			$title = 'New community map entry: ' . $this->name
		);

		// create the PR
		$pr = Github::createPr(static::$repo, $branch, $title);

		// store the PR URL
		$this->pr = $pr->json()['html_url'];

		return true;
	}

	public static function validate(
		string $name,
		string $place,
		string $country,
		string|null $business = null,
		string|null $forum = null,
		string|null $github = null,
		string|null $discord = null,
		string|null $instagram = null,
		string|null $mastodon = null,
		string|null $linkedin = null,
	): bool {
		V::value($name, [
			'required',
			'minlength' => 1,
			'maxlength' => 100,
		], [
			'required'  => 'Please enter a name',
			'minlength' => 'Please enter a longer name',
			'maxlength' => 'Please enter a shorter name',
		]);

		V::value($place, [
			'required',
			'minlength' => 2,
			'maxlength' => 100,
		], [
			'required'  => 'Please enter a place',
			'minlength' => 'Please enter a longer place name',
			'maxlength' => 'Please enter a shorter place name',
		]);

		V::value($country, [
			'required',
			'in' => [static::countries()],
		], [
			'required' => 'Please enter a country',
			'in'       => 'Please enter a valid country',
		]);

		if (empty($business) === false) {
			V::value($business, [
				'minlength' => 2,
				'maxlength' => 100,
			], [
				'minlength' => 'Please enter a longer business name (min. 2 characters)',
				'maxlength' => 'Please enter a shorter business name (max. 100 characters)',
			]);
		}

		if (empty($forum) === false) {
			V::value($forum, [
				'minlength' => 2,
				'maxlength' => 32,
			], [
				'minlength' => 'Please enter a longer Forum username (min. 2 characters)',
				'maxlength' => 'Please enter a shorter Forum username (max. 32 characters)',
			]);
		}

		if (empty($github) === false) {
			V::value($github, [
				'minlength' => 2,
				'maxlength' => 32,
			], [
				'minlength' => 'Please enter a longer Github username (min. 2 characters)',
				'maxlength' => 'Please enter a shorter Github username (max. 32 characters)',
			]);
		}

		if (empty($discord) === false) {
			V::value($discord, [
				'minlength' => 2,
				'maxlength' => 32,
			], [
				'minlength' => 'Please enter a longer Discord username (min. 2 characters)',
				'maxlength' => 'Please enter a shorter Discord username (max. 32 characters)',
			]);
		}

		if (empty($mastodon) === false) {
			V::value($mastodon, [
				'minlength' => 2,
				'maxlength' => 100,
			], [
				'minlength' => 'Please enter a longer Mastodon username (min. 2 characters)',
				'maxlength' => 'Please enter a shorter Mastodon username (max. 100 characters)',
			]);
		}

		if (empty($instagram) === false) {
			V::value($instagram, [
				'minlength' => 2,
				'maxlength' => 32,
			], [
				'minlength' => 'Please enter a longer Instagram username (min. 2 characters)',
				'maxlength' => 'Please enter a shorter Instagram username (max. 32 characters)',
			]);
		}

		if (empty($linkedin) === false) {
			V::value($linkedin, [
				'minlength' => 2,
				'maxlength' => 32,
			], [
				'minlength' => 'Please enter a longer LinkedIn username (min. 2 characters)',
				'maxlength' => 'Please enter a shorter LinkedIn username (max. 32 characters)',
			]);
		}

		return true;
	}

}
