<?php

return function ($kirby) {
	return $kirby->collection('brands')->filterBy('tag', 'hospitality', ',');
};
