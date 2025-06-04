<?php

class MeetPage extends DefaultPage
{
	/**
	 * Returns the URL to the iCalendar file for this page
	 * `webcal` protocol is used to allow users to add the calendar to their own
	 */
	public function webcalUrl(): string
	{
		return 'webcal://' . $this->kirby()->environment()->host() . '/' . $this->slug() . '.ical';
	}
}
