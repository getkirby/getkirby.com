<?php

use Kirby\Cms\Pages;
use Kirby\Filesystem\F;

class ReferenceIconsPage extends ReferenceSectionPage
{
	public function children(): Pages
	{
		if ($this->children !== null) {
			return $this->children;
		}

		$pages    = parent::children();
		$children = [];
		$root     = $this->kirby()->root('panel') . '/dist/img/icons.svg';
		$file     = F::read($root);
		$svg      = new SimpleXMLElement($file);

		foreach ($svg->defs->children() as $symbol) {
			$slug       = str_replace('icon-', '', $symbol->attributes()->id);
			$children[] = [
				'slug'     => $slug,
				'template' => 'reference-icon',
				'model'    => 'reference-icon',
				'num'      => 0,
				'content'  => [
					'intro' => '&lt;k-icon type="' . $slug . '"&gt;',
					...$pages->find($slug)?->content()->toArray() ?? []
				]
			];
		}

		return $this->children = Pages::factory($children, $this)->sortBy('slug');
	}
}
