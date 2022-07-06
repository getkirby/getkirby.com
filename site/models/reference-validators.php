<?php

use Kirby\Cms\Pages;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;
use Kirby\Reference\SectionPage;

class ReferenceValidatorsPage extends SectionPage
{

	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$children   = [];
		$validators = array_keys(V::$validators);
		$pages	  = parent::children();

		foreach ($validators as $validator) {
			$slug = Str::kebab($validator);

			if ($page = $pages->find($slug)) {
				$content = $page->content()->toArray();
			} else {
				$content = [];
			}

			$children[] = [
				'slug'	 => $slug,
				'num'	  => 0,
				'model'	=> 'reference-validator',
				'template' => 'reference-validator',
				'parent'   => $this,
				'content'  => array_merge(
					$content,
					['title' => $validator]
				)
			];
		}

		return Pages::factory($children, $this);
	}

}
