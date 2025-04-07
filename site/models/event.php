<?php

use Kirby\Cms\Page;
use Kirby\Content\Field;
use Kirby\Toolkit\Str;

class EventPage extends Page
{
	public function date(): Field
	{
		return parent::date()->value(
			$this->num() . ' ' . $this->start() . ' ' . $this->timezone()
		);
	}

	public function datetime(): DateTime
	{
		return new DateTime(
			(string)$this->date(),
			new DateTimeZone((string)$this->timezone())
		);
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
		$title = $this->fold($this->title()->value());
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
