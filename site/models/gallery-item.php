<?php

use Kirby\Cms\Page;

class GalleryItemPage extends Page
{
	protected function setFiles(array|null $files = null): static
	{
		if (is_array($files)) {
			$this->files = PartnersPage::virtualFileFactory($files, $this);
			return $this;
		}

		return parent::setFiles($files);
	}
	
	public function url( $options = null): string
	{
		return $this->link()->value();
	}
}
