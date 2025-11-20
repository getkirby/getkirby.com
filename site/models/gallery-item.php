<?php

class GalleryItemPage extends \Kirby\Cms\Page
{
	public function files(): Files
	{
		if ($this->files !== null) {
			return $this->files;
		}
		
		$collection   = new Files([], $this);
		$galleryImage = $this->content()->get('image')->value();
		$file         = [
			'filename' => baseName($galleryImage),
			'url'      => $galleryImage,
			'parent'   => $this,
		];
		
		$image = new VirtualFile($file);
		
		$collection->append($image->id(), $image);

		return $this->files = $collection;
	}
}