<?php

use Kirby\Cdn\VirtualFile;
use Kirby\Cms\Files;
use Kirby\Cms\Page;
use Kirby\Cms\Pages;

class KosmosPage extends DefaultPage
{
	protected static Pages|null $subpages = null;

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

		$data   = [];
		$issues = [];

		try {
			$request = Remote::get(option('kosmosApi'));

			if ($request->code() === 200) {
				$data = $request->json(true);
			}

			$issues = A::map(
				array_keys($data),
				fn($issue) => [
					'slug'     => $issue,
					'parent'   => $this,
					'url'      => $this->url() . '/' . $issue,
					'model'    => 'kosmos-issue-virtual',
					'template' => 'kosmos-issue-virtual',
					'isDraft'  => false,
					'num'      => strtotime($data[$issue]['date']),
					'isListed' => true,
					'content'  => [
						'layouts' => $data[$issue]['content'] ?? null,
						'date'    => $data[$issue]['date'] ?? null,
						'title'   => $data[$issue]['title'] ?? null
					],
					'files'    => array_values($data[$issue]['files'])
				]
			);

		} catch (Exception) {
		}

		return $this->children = $this->subpages()->add(Pages::factory($issues, $this));
	}

	/**
	 * Creates a collection of `VirtualFile` objects from array data that comes
	 * from the partners API's `apiArray()` file method
	 */
	public static function virtualFileFactory(array $files, Page $parent): Files
	{
		$collection = new Files([], $parent);

		foreach (array_filter($files) as $file) {
			$file = VirtualFile::factory(
				[
					 'filename'   => basename($file['url']),
					 'url'        => $file['url'],
					 'width'      => $file['width'],
					 'height'     => $file['height'],
					 'parent'     => $parent,
					 'collection' => $collection,
					 'content'    => [
						 'isCover' => $file['cover']
					 ]
 				]
			);

			$collection->data[$file->id()] = $file;
		}

		return $collection;
	}
}
