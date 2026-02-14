<?php

return function ($site) {
	
	$cases = $site
		->find('love')
		->children()
		->listed();
	
	$partnerGallery = $site
		->find('partners')
		->grandChildren()
		->filterBy('showcase', true)
		->filter(fn($item) => in_array(
				rtrim($item->link()->value()),
				array_map(fn($link) => rtrim($link, '/'),
					$cases->pluck('link', ',')
				), true) === false);
	
	return $cases
		->add($partnerGallery);
};
