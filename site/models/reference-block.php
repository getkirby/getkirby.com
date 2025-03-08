<?php

use Kirby\Cms\App;

class ReferenceBlockPage extends ReferenceArticlePage
{
	public function source(): string
	{
		$url  = option('github.url') . '/kirby/tree/' . App::version();
		$url .= '/config/blocks/' . $this->name() . '/';
		return $url;
	}
}
