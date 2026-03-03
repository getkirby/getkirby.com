<?php

use Kirby\Cms\Page;

class EpisodePage extends Page
{
	protected function setFiles(array|null $files = null): static
	{
		if (is_array($files)) {

			$this->files = KosmosPage::virtualFileFactory($files, $this);
			return $this;
		}
		
		return parent::setFiles($files);
	}
	
	public function cover()
	{
		return parent::cover()->toFile() ?? $this->files()->first();
	}
}