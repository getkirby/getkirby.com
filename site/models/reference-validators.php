<?php

use Kirby\Cms\Pages;
use Kirby\Reference\ReferenceSectionPage;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class ReferenceValidatorsPage extends ReferenceSectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children   = [];
		$validators = array_keys(V::$validators);
		$pages      = parent::children();

		foreach ($validators as $validator) {
			$children[] = [
				'slug'     => $slug = Str::kebab($validator),
				'num'      => 0,
				'model'    => 'reference-validator',
				'template' => 'reference-validator',
				'parent'   => $this,
				'content'  => [
					...$pages->find($slug)?->content()->toArray() ?? [],
					'title' => $validator
				]
			];
		}

		return $this->children = Pages::factory($children, $this);
	}
}
