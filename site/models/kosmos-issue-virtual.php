<?php

use Kirby\Cms\Page;

class KosmosIssueVirtualPage extends Page
{
	public function cover()
	{
		return $this->files()->filterBy('isCover', true)?->first() ?? $this->files()->first();
	}

	/**
	 * Same as `KosmosIssuePage::metadata()`
	 */
	public function metadata(): array
	{
		return [
			'ogtitle'     => 'Kirby Kosmos Episode ' . $this->uid(),
			'description' => 'Read issue no. ' . $this->uid() . ' of our monthly newsletter online.',
			'thumbnail' => [
				'lead'  => 'Kirby Kosmos',
				'title' => 'Episode ' . $this->uid(),
				'image' => $this->cover()
			],
			'changefreq' => 'never'
		];
	}

	protected function setFiles(array|null $files = null): static
	{
		if (is_array($files)) {
			$this->files = KosmosPage::virtualFileFactory($files, $this);
			return $this;
		}

		return parent::setFiles($files);
	}
}
