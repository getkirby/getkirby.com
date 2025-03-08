<?php

use Kirby\Cms\App;

class ReferencePanelSectionPage extends ReferenceArticlePage
{
	public function source(): string
	{
		$url  = option('github.url') . '/kirby/tree/' . App::version();
		$url .= '/config/sections/' . $this->name() . '.php';
		return $url;
	}
}
