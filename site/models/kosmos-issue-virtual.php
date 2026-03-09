<?php

use Kirby\Cms\Page;

class KosmosIssueVirtualPage extends Page
{
	public function cover()
	{
		return $this->files()->filterBy('isCover', true)?->first() ?? $this->files()->first();
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
