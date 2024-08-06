<?php

return function ($kirby) {
	return $kirby->collection('brands')->filterBy('featured', true);
};
