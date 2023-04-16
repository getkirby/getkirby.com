<?php

return function ($kirby) {
	return $kirby->collection('cases')->find([
		'berlin-in-bewegung',
		'fairclimatefund',
		'fridays-for-future-at',
		'klimaliste-berlin',
		'natucate',
		'strassenfeger',
		'teteenlair'
	]);
};
