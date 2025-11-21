<?php

use Kirby\Cms\Files;

class MeetPage extends DefaultPage
{
	public function gallery(int $limit = 40): Files
	{
		// Collect shuffled image collections per event
		$events = $this->find('events')->children()->listed()->flip();
		$events = $events->values(fn ($event) => $event->images()->shuffle());

		$collected = [];
		$count     = 0;

		// Round-robin: each loop over $images tries to take one image per child
		while ($count < $limit) {
			$empty = true;

			foreach ($events as $key => $photos) {
				if ($count >= $limit) {
					break 2;
				}

				if ($photo = $photos->first()) {
					$collected[] = $photo;
					$events[$key] = $photos->not($photo);
					$count++;
					$empty = false;
				}
			}

			// no images left in any child
			if ($empty) {
				break;
			}
		}

		return (new Files($collected))->shuffle();
	}

	/**
	 * Returns the URL to the iCalendar file for this page
	 * `webcal` protocol is used to allow users to add the calendar to their own
	 */
	public function webcalUrl(): string
	{
		return 'webcal://' . $this->kirby()->environment()->host() . '/' . $this->slug() . '.ical';
	}
}
