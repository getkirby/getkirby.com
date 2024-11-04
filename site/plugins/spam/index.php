<?php

namespace Kirby\Honey;

use Exception;

class Time
{
	public static function get(): string
	{
		$time = time();
		$time .= ':' . hash_hmac('sha256', $time, 'kirby-2');
		return $time;
	}

	/**
	 * Prevent submissions faster than 1 minute (spam protection)
	 */
	public static function validate(string $time): void
	{
		$time = explode(':', $time);

		if ($time[0] > time() - 60) {
			throw new Exception('To protect against spam, we block submissions faster than 1 minute. Please try again, sorry for the inconvenience.');
		}

		$hash = hash_hmac('sha256', $time[0], 'kirby-2');

		if (hash_equals($hash, $time[1]) !== true) {
			throw new Exception('Spam protection hash was manipulated');
		}
	}
}
