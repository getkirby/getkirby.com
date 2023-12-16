<?php

return function ($site) {
	return $site->find(
		'contact',
		'privacy',
		'license',
		'security',
		'styleguide'
	);
};
