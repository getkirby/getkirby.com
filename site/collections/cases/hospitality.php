<?php

return function ($site) {
	return $site->find('love')->children()->published()->filterBy('tag', 'hospitality', ',');
};
