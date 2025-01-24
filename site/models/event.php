<?php

use Kirby\Cms\Page;
use Kirby\Content\Field;

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
