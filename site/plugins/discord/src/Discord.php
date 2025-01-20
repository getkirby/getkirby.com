<?php

namespace Kirby\Discord;

use DateTime;
use Kirby\Http\Remote;

/**
 * Sends a webhook to a Discord channel
 *
 * @author Kirby Team <mail@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Discord
{
	public static function submit(
		string $webhook,
		Author|array|null $author = null,
		string|null $avatar = null,
		int|string|null $color = null,
		string|null $content = null,
		string|null $description = null,
		bool $dryrun = false,
		array $fields = [],
		string|null $footer = null,
		string|null $image = null,
		string|null $thumbnail = null,
		DateTime|string|null $timestamp = null,
		string|null $title = null,
		string|null $username = null,
	): Remote|array {
		if (is_string($color) === true) {
			$color = hexdec(str_replace('#', '', $color));
		}

		// format the timestamp correctly
		if ($timestamp instanceof DateTime) {
			$timestamp = $timestamp->format('Y-m-d\TH:i:s.v\Z');
		}

		$embed = [
			'author'      => Author::from($author)?->toArray(),
			'color'       => $color,
			'description' => $description,
			'fields'      => array_map(fn ($field) => Field::from($field)->toArray(), $fields),
			'footer'      => ['text' => $footer],
			'image'       => ['url'  => $image],
			'thumbnail'   => ['url'  => $thumbnail],
			'timestamp'   => $timestamp,
			'title'       => $title,
		];

		$data = [
			'avatar_url' => $avatar,
			'content'    => $content,
			'embeds'     => [$embed],
			'username'   => $username,
		];

		if ($dryrun === true) {
			return $data;
		}

		return Remote::post(
			$webhook,
			[
				'data'    => json_encode($data),
				'headers' => ['Content-Type' => 'application/json'],
			]
		);
	}
}
