<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;

class ReferenceHooksPage extends ReferenceSectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$pages    = parent::children();
		$children = array_map(function ($hook) use ($pages) {

			$slug    = Str::slug($hook['Name']);
			$content = [
				'title'     => $hook['Name'],
				'arguments' => implode(', ', Str::split($hook['Arguments'])),
				'type'      => $hook['Type'],
				'return'    => $hook['Return'] ?? null,
				...$pages->find($slug)?->content()->toArray() ?? []
			];

			return [
				'slug'     => $slug,
				'template' => 'reference-hook',
				'model'    => 'reference-hook',
				'num'      => 0,
				'content'  => $content
			];
		}, csv($this->root() . '/hooks.csv'));

		return $this->children = Pages::factory($children, $this);
	}
}
