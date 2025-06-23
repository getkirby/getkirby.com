<?php

use Kirby\Cms\File;

class HomeStoryPage extends DefaultPage
{
	public function storyImageDark(): File
	{
		return $this->images()->findBy('name', 'panel-dark');
	}

	public function storyImageLight(): File
	{
		return $this->images()->findBy('name', 'panel');
	}

	public function storyImageDarkSrc(): string
	{
		return $this->storyImageDark()->thumb($this->storyImageSrcSize())->url();
	}

	public function storyImageLightSrc(): string
	{
		return $this->storyImageLight()->thumb($this->storyImageSrcSize())->url();
	}

	public function storyImageDarkSrcset(): string
	{
		return $this->storyImageDark()->srcset($this->storyImageSrcsetSizes());
	}

	public function storyImageLightSrcset(): string
	{
		return $this->storyImageLight()->srcset($this->storyImageSrcsetSizes());
	}

	public function storyImageSrcSize(): array
	{
		return ['width' => 1520];
	}

	public function storyImageSrcsetSizes(): array
	{
		return [
			400,
			600,
			800,
			1000,
			1200,
			1520,
			2000,
			2400,
			3040
		];
	}
}
