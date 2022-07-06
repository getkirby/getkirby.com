<?php


class ReleasePage extends Page
{

	public function contentFileName(?string $languageCode = null): string
	{
		return 'release';
	}

	public function intendedTemplate()
	{
		return $this->intendedTemplate = $this->intendedTemplate ?? $this->kirby()->template('release-' . $this->content()->version());
	}

	public function url($options = null): string
	{
		return $this->parent()->url() . '/' . str_replace('-', '.', $this->slug());
	}

}
