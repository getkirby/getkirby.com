<?php

use Kirby\Content\Field;
use Kirby\Toolkit\Str;

class EventPage extends DefaultPage
{
	public function date(string $time = 'start'): Field
	{
		return parent::date()->value(
			$this->num() . ' ' . $this->{$time}() . ' ' . $this->timezone()
		);
	}

	public function datetime(
		string|null $timezone = null,
		string $time = 'start',
	): DateTime {
		return new DateTime(
			datetime: $this->date($time),
			timezone: new DateTimeZone($timezone ?? $this->timezone())
		);
	}

	public function end(): Field
	{
		if (parent::end()->isNotEmpty()) {
			return parent::end();
		}

		$start = $this->start();
		$dt    = DateTime::createFromFormat('H:i:s', $start);
		$dt->modify('+2 hours');
		return parent::end()->value($dt->format('H:i:s'));
	}

	public function expiryTime(): int
	{
		// expire each event two hours after it started
		return $this->datetime()->getTimestamp() + (60 * 60 * 2);
	}

	/**
	 * This method folds the title into multiple lines
	 * and lines of text shouldn't be longer than 75 octets
	 * https://icalendar.org/iCalendar-RFC-5545/3-1-content-lines.html
	 */
	public function fold($string, $maxLength = 50): string
	{
		$length    = Str::length($string);
		$lines     = [];

		for ($i = 0; $i < $length; $i += $maxLength) {
			$chunk   = Str::substr($string, $i, $maxLength);
			// add a space to the beginning of the line if it's not the first line
			$lines[] = ($i > 0 ? ' ' : '') . $chunk;
		}

		return implode("\r\n", $lines);
	}

	public function foldTitle(): Field
	{
		$title = $this->fold($this->shortTitle()->value());
		return parent::title()->value($title);
	}

	public function foldLink(): Field
	{
		$link = $this->fold($this->link()->value());
		return parent::link()->value($link);
	}

	public function icon(): string
	{
		return parent::icon()->or(match (true) {
			$this->isMeetup() => '📍',
			default           => '🗓️'
		});
	}

	public function isMeetup(): bool
	{
		return $this->city()->isNotEmpty() === true;
	}

	public function isUpcoming(): bool
	{
		return $this->expiryTime() >= time();
	}

	public function shortTitle(): Field
	{
		$title = [];

		if ($this->content()->get('title')->isNotEmpty()) {
			$title[] = (string)parent::title();
		}

		if ($this->city()->isNotEmpty()) {
			$title[] = 'Kirby Meetup ' . $this->city() . ', ' . $this->country();
		}

		if ($this->conference()->isNotEmpty()) {
			$title[] = '@ ' . $this->conference();
		}

		if ($this->issue()->isNotEmpty()) {
			$title[] = '• №' . $this->issue();
		}

		return parent::shortTitle()->value(implode(' ', $title));
	}

	public function start(): Field
	{
		return parent::start()->or('18:00:00');
	}

	public function timezone(): Field
	{
		return parent::timezone()->or('Europe/Berlin');
	}

	public function title(): Field
	{
		if ($this->isMeetup() === true) {
			return parent::title()->value('Kirby Community Meetup • ' . $this->shortTitle());
		}

		return parent::title();
	}
}
