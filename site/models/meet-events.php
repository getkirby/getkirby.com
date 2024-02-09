<?php

use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Http\Remote;
use Kirby\Toolkit\Date;
use Kirby\Toolkit\Str;

class MeetEventsPage extends Page
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children = [];
		$events   = $this->getData();

		foreach ($events as $event) {
			$timezone   = 'CET';
			$children[] = [
				'slug'     => Str::kebab($event['name']),
				'num'      => 0,
				'model'    => 'link',
				'template' => 'link',
				'parent'   => $this,
				'content'  => [
					'title'    => $event['name'],
					'link'     => $event['entity_metadata']['location'],
					'date'     => Date::optional($event['scheduled_start_time'])->setTimezone(new DateTimeZone($timezone))->format('Y-m-d H:i:s'),
					'timezone' => $timezone
				]
			];
		}

		return $this->children = Pages::factory($children, $this);
	}

	protected function getData(): array
	{
		$cache = $this->kirby()->cache('meet');

		if (!$data = $cache->get('events')) {
			$data = $this->getDataFromApi();
			$cache->set('events', $data, 60 * 60);
		}

		return $data;
	}

	protected function getDataFromApi(): array
	{
		$data = Remote::get(
			'https://canary.discord.com/api/v10/guilds/' . $this->kirby()->option('keys.discord.guild') . '/scheduled-events',
			[
				'headers' => [
					'Authorization' => 'Bot ' . $this->kirby()->option('keys.discord.bot'),
					'Content-Type' => 'application/json'
				],
			]
		);

		$data = $data->json();
		$data = array_filter($data, fn ($event) => $event['entity_type'] === 3);

		usort(
			$data,
			fn ($a, $b) => strtotime($a['scheduled_start_time']) - strtotime($b['scheduled_start_time'])
		);

		return $data;
	}
}
