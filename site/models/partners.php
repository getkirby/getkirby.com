<?php

use Kirby\Cdn\VirtualFile;
use Kirby\Cms\Files;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;
use Kirby\Http\Remote;
use Kirby\Toolkit\A;

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
		try {
			$request = Remote::get(
				option('partners.url') . '?apiToken=' .
				option('keys.partnerAccessToken')
			);

			if ($request->code() === 200) {
				$data = $request->json(true);
			}

			$partners = A::map(
				array_keys($data),
				fn($partner) => [
					'slug'     => $partner,
					'parent'   => $this,
					'url'      => $this->url() . '/' . $partner,
					'model'    => 'partner',
					'template' => 'partner',
					'isDraft'  => false,
					'num'      => ($data[$partner]['isPreview'] ?? false) === false ? 0 : null,
					'isListed' => ($data[$partner]['isPreview'] ?? false) === false,
					'content'  => [
						'title'           => $data[$partner]['title'],
						'plan'            => $data[$partner]['plan'],
						'summary'         => $data[$partner]['summary'],
						'description'     => $data[$partner]['description'],
						'expertise'       => $data[$partner]['expertise'],
						'people'          => $data[$partner]['people'],
						'test'            => $data[$partner]['card'],
						'languages'       => $data[$partner]['languages'],
						'region'          => $data[$partner]['region'],
						'subtitle'        => $data[$partner]['subtitle'],
						'location'        => $data[$partner]['location'] ?? null,
						'preview'         => $data[$partner]['token'],
						'changes'         => $data[$partner]['changes'] ?? null,
						'pluginDeveloper' => $data[$partner]['pluginDeveloper'] ?? null,
					],
					'files' => [
						$data[$partner]['card'] ?? null,
						$data[$partner]['stripe'] ?? null,
						$data[$partner]['avatar'] ?? null,
					]
				]
			);
		} catch (Exception) {}

		return $this->children = $this->subpages()->add(Pages::factory($partners, $this));
	}

	/**
	 * Creates a collection of `VirtualFile` objects from array data that comes
	 * from the partners API's `apiArray()` file method
	 */
	public static function virtualFileFactory(array $files, Page $parent): Files
	{
		$collection = new Files([], $parent);

		foreach (array_filter($files) as $file) {
			$file = VirtualFile::factory([
				'filename'   => basename($file['url']),
				'url'        => $file['url'],
				'width'      => $file['width'],
				'height'     => $file['height'],
				'parent'     => $parent,
				'collection' => $collection
			]);

			$collection->data[$file->id()] = $file;
		}

		return $collection;
	}
}
