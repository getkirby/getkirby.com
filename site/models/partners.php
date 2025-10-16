<?php

use Kirby\Cms\Pages;
use Kirby\Cms\Url;
use Kirby\Uuid\Uuid;

class PartnersPage extends DefaultPage
{
	static $subpages = null;
	
	public function subpages(): Pages
	{
		if (static::$subpages) {
			return static::$subpages;
		}
		
		return static::$subpages = Pages::factory($this->inventory()['children'], $this);
	}
	
	public function children(): Pages
	{
		if ($this->children instanceof Pages) {
			return $this->children;
		}
		
		$partners = [];
		$request  = Remote::get(option('partnerhub.url'));
		
		if ($request->code() === 200) {
			$partners = $request->json(true);
		}
		
		$partners = A::map(
			array_keys($partners),
			fn ($partner) => [
				'slug'     => $partner,
				'parent'   => $this,
				'url'      => $this->url() . '/' . $partner,
				'model'    => 'partner',
				'template' => 'partner',
				'isDraft'  => false,
				'num'      => ($partners[$partner]['isPreview'] ?? false) === false ? 0 : null,
				'isListed' => ($partners[$partner]['isPreview'] ?? false) === false,
				'content' => [
						'title'       => $partners[$partner]['title'],
						'plan'        => $partners[$partner]['plan'],
						'summary'     => $partners[$partner]['summary'],
						'description' => $partners[$partner]['description'],
						'people'      => $partners[$partner]['people'],
						'test'        => $partners[$partner]['card'],
						'languages'   => $partners[$partner]['languages'],
						'region'      => $partners[$partner]['region'],
						'subtitle'    => $partners[$partner]['subtitle'],
						'location'    => $partners[$partner]['location'] ?? null,
						'token'       => $partners[$partner]['token'],
						'card'        => $partners[$partner]['card'] ?? null,
						'stripe'      => $partners[$partner]['stripe'] ?? null,
						'avatar'      => $partners[$partner]['avatar'] ?? null,
					
					],
				'files'   => $this->getImages($partners[$partner]),
				]
		);

		return $this->children = $this->subpages()->add(Pages::factory($partners, $this));
	}
	
	public function getImages(array $partner)
	{
		$files = [];
		
		foreach (array_filter(
			 [
			     $partner['card'] ?? null,
			     $partner['stripe'] ?? null,
			     $partner['avatar'] ?? null
			 ]
            ) as $file) {
			$file = [
				'filename' => baseName($file),
				'url'      => $file,
			];
			
			$files[] = $file;
			
		}

		return $files;
	}
}